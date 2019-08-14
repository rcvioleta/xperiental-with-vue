    <template>
    <b-container fluid>
        <b-row>
            <b-col>
                <h1>Registration Fee Record: <strong>{{studentName}}</strong></h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-card>
                    <b-row align-h="end">
                        <!-- <b-col cols="6" class="pt-3" align="left">
                            <b-form-group class="mb-10 mr-3 float-left">
                                <b-form-select style="width: 160px" v-model="filter_year">
                                    <option value="" disabled>Year Filter</option>
                                    <option value="0">2019</option>
                                    <option value="1">2018</option>
                                </b-form-select>
                            </b-form-group>
                        </b-col> -->
                        <b-col cols="3">
                            <b-form-group class="mb-10" align="right">
                                <button class="btn btn-primary pull-right mr-0" @click="show=true;okName='Save';">Add Registration Fee <i class="batch-icon batch-icon-plus"></i></button>
                            </b-form-group>
                        </b-col>
                    </b-row>
                    <b-row>
                        <b-col>
                            <b-table striped hover 
                            :items="accountList" 
                            :fields="fields" 
                            :per-page="perPage" 
                            :current-page="currentPage"
                            >
                                <!-- <template slot="payment_status" slot-scope="data">
                                    {{ data.item.payment_status == '0'? 'Partial Payment' : 'Full Payment' }}
                                </template> -->
                                <template slot="action" slot-scope="data">
                                    <button class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button" @click="editPayment(data.item)">
                                        Edit <i class="fa fa-pencil"></i>
                                    </button>
                                </template>

                            </b-table>
                        </b-col>
                    </b-row>
                    <b-row align-h="between">
                        <b-col cols="3">
                            Total Entries: {{ totalRows }}
                        </b-col>
                        <b-col>
                            <b-pagination
                            v-model="currentPage"
                            :total-rows="totalRows"
                            :per-page="perPage"
                            align="right"
                            ></b-pagination>
                        </b-col>
                    </b-row>
                </b-card>
            </b-col>
        </b-row>
        <b-modal v-model="show" :title="okName + ' Registration Fee'" hide-footer>
            <b-form @submit="payment"> 
                <b-row>
                    <b-col>
                        <b-form-group label="Amount">
                            <b-form-input v-model="accountData.amount" style="width: 100%;" required></b-form-input>
                        </b-form-group>
                    </b-col>
                    <b-col>
                        <b-form-group label="Payment Date" required>
                            <b-form-input v-model="accountData.payment_date" type="date" style="width: 100%;"></b-form-input>
                        </b-form-group>
                    </b-col>
                </b-row>
                <!-- <b-row>
                    <b-col cols="6">
                        <b-form-group label="Payment Status">
                            <b-form-select v-model="accountData.payment_status" required>
                                <option value="" disabled>Select Status</option>
                                <option value="0">Partial Payment</option>
                                <option value="1">Full Payment</option>
                            </b-form-select>
                        </b-form-group>
                    </b-col>
                </b-row> -->
                <b-row>
                    <b-col>
                        <b-form-group label="Remarks">
                            <b-form-textarea v-model="accountData.remarks" rows="3" max-rows="6"></b-form-textarea>
                        </b-form-group>
                    </b-col>
                </b-row>
                <b-row>
                    <hr>
                    <div slot="modal-footer" class="w-100">
                        <b-button
                          variant="danger"
                          class="float-left ml-4"
                          @click="deleteForm"
                          v-if="okName=='Update'"
                        >
                          DELETE
                        </b-button>
                        <b-button
                          variant="primary"
                          class="float-right mr-4"
                          type="submit"
                        >
                          {{ okName }}
                        </b-button>
                        <b-button
                          class="float-right mr-4"
                          @click="resetFields"
                        >
                          CANCEL
                        </b-button>
                    </div>
                </b-row>
            </b-form>
        </b-modal>
    </b-container>
</template>

<script>
    export default {
        props: ['id'],
        data() {
            return {
                show: false,
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                accountList: [],
                student: [],
                totalRows: '',
                accountData: {
                    student_id : '',
                    amount: '',
                    payment_type : '1',
                    payment_status : '1',    
                    payment_date: '',
                    remarks: ''
                },
                filter_year: '',
                fields: [
                    'payment_date',
                    'amount',
                    // 'payment_status',
                    'remarks',
                    'action',
                ],
                okName: '',
                accountID: '',
                studentName: ''
            }
        },
        created() {
            axios.get('/admin/studentaccount/edit/0/' + this.id)
            .then(response => {
                this.studentName = '(ID: ' + response.data.student.id_num + ') "' + 
                response.data.student.nickname + '" ' + 
                response.data.student.first_name + ' ' + 
                (response.data.student.middle_name == '' ? '' : (response.data.student.middle_name + ' ')) + response.data.student.last_name;
                this.accountList = response.data.accounts;
                this.totalRows = response.data.accounts.length;
                this.student = response.data.student;
                this.accountData.student_id = response.data.student.id;
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
        methods: {
            editPayment(data) {
                this.show = true;
                this.okName = 'Update';

                this.accountData.amount = data.amount;
                this.accountData.payment_type = data.payment_type;
                this.accountData.payment_status = data.payment_status;
                this.accountData.payment_date = data.payment_date;
                this.accountData.remarks = data.remarks;
                this.accountID = data.student_account_id;
            },
            payment(e) {
                e.preventDefault();

                if(this.okName == 'Save')
                    var url = '/admin/studentaccount/store';
                else
                    var url = '/admin/studentaccount/update/' + this.accountID;

                axios.post(url, this.accountData)
                .then(response => {

                    this.accountList = response.data.newlist;
                    this.totalRows = response.data.newlist.length;
                    this.resetFields();
                    swal("Success!", response.data.message, "success");

                })
                .catch(err=>{
                    console.log("error", err);
                    swal("Error!", 
                        "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                        "error");
                });

            },
            deleteForm() {
                swal({
                    title: "Payment Deletion Warning",
                    text: "Are you sure you want to delete this Payment record?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true
                }).then(willDelete => {
                    if (willDelete) {
                        axios.post('/admin/studentaccount/delete/' + this.accountID, this.accountData)
                        .then(response => {

                            this.accountList = response.data.newlist;
                            this.totalRows = response.data.newlist.length;
                            swal("Payment record successfully deleted!", { icon: "success" });

                        })
                        .catch(err=>{
                            console.log("error", err);
                            swal("Error!", 
                                "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                                "error");
                        });

                        this.resetFields();

                    } else swal("Payment record was kept");
                });
            },
            resetFields() {
                this.accountData.payment_status = '1';
                this.accountData.payment_type = '1';
                this.accountData.payment_date = '';
                this.accountData.remarks = '';
                this.accountData.amount = '';
                this.show = false;
            }
        },
    }
</script>
