<template>
    <b-container fluid>
        <b-row class="mb-5">
            <b-col>
                <b-form-group label="ID #">
                    {{ student.id_num }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Nickname">
                    {{ student.nickname }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Student Name">
                    {{ student.first_name }} {{ student.middle_name }} {{ student.last_name }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Registration Date">
                    {{ student.registration_date }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="First Payment Date">
                    {{ accountDetails.first_payment.payment_date }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Last Payment Date">
                    {{ accountDetails.last_payment.payment_date }}
                </b-form-group>
            </b-col>
        </b-row>
        <b-row class="mb-5">
            <b-col>
                <b-form-group label="# of Payments">
                    {{ accountDetails.payment_count }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Total Credit Payment">
                    {{ accountDetails.total_payment }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Total Used Credits">
                    {{ accountDetails.used_credits }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Total Credit Cost">
                    {{ accountDetails.credit_cost }}
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Balance">
                    <span v-if="(accountDetails.total_payment - accountDetails.credit_cost) > 0" style="color: green;">
                        (+){{ accountDetails.total_payment - accountDetails.credit_cost }}
                    </span>
                    <span v-else-if="(accountDetails.total_payment - accountDetails.credit_cost) == 0" style="color: green;">
                        {{ accountDetails.total_payment - accountDetails.credit_cost }}
                    </span>
                    <span v-else style="color: red;">
                        {{ accountDetails.total_payment - accountDetails.credit_cost }}
                    </span>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group :label="'Annual Payment (' + currentYear +')'">
                    <span v-if="accountDetails.annual_fee == '0'" style="color: red;">Unpaid</span>
                    <span v-else style="color: green;">Paid</span>
                    <!-- {{ accountDetails.annual_fee == '0'? 'Unpaid' : 'Paid' }} -->
                </b-form-group>
            </b-col>
        </b-row>
        <hr>
        <b-row align-h="between">
            <b-col cols="3" class="pt-3" align="left">
                <b-form-group class="mb-10">
                    <b-form-input v-model="filter" placeholder="Search"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="3">
                <b-form-group class="mb-10" align="right">
                    <button class="btn btn-primary pull-right mr-0" @click="show=true;okName='Save';">Add Payment <i class="batch-icon batch-icon-plus"></i></button>
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
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="payment_type" slot-scope="data">
                    {{ data.item.payment_type == '0'? 'Annual Fee' : 'Credits Fee' }}
                </template>
                <template slot="payment_status" slot-scope="data">
                    {{ data.item.payment_status == '0'? 'Partial Payment' : 'Full Payment' }}
                </template>
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
    <b-modal v-model="show" :title="okName + ' Payment'" hide-footer>
        <b-row>
            <b-col>
                <b-form-group label="Amount">
                    <b-form-input v-model="accountData.amount" style="width: 100%;"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Payment Type">
                    <b-form-select v-model="accountData.payment_type">
                        <option value="" disabled>Select Type</option>
                        <option value="1">Credits Fee</option>
                        <option value="0">Annual Fee</option>
                    </b-form-select>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-form-group label="Payment Status">
                    <b-form-select v-model="accountData.payment_status">
                        <option value="" disabled>Select Status</option>
                        <option value="0">Partial Payment</option>
                        <option value="1">Full Payment</option>
                    </b-form-select>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Payment Date">
                    <b-form-input v-model="accountData.payment_date" type="date" style="width: 100%;"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
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
                >
                  DELETE
                </b-button>
                <b-button
                  variant="primary"
                  class="float-right mr-4"
                  @click="payment"
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
    </b-modal>
</b-container>
</template>

<script>

    export default {
        props: ['accounts', 'student', 'accountInfo', 'currentYear'],
        data() {
            return {
                show: false,
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                accountList: this.accounts,
                totalRows: this.accounts.length,
                accountData: {
                    student_id : this.student.id,
                    amount: '',
                    payment_type : '',
                    payment_status : '',    
                    payment_date: '',
                    remarks: ''
                },
                accountDetails: this.accountInfo,
                filter: null,
                fields: [
                    'payment_date',
                    'amount',
                    'payment_type',
                    'payment_status',
                    'remarks',
                    'action',
                ],
                okName: '',
                accountID: '',
            }
        },
        created() {

        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
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
            payment() {

                if(this.okName == 'Save')
                    var url = '/admin/studentaccount/store';
                else
                    var url = '/admin/studentaccount/update/' + this.accountID;


                if(this.requireAllFields()) {
                    axios.post(url, this.accountData)
                    .then(response => {

                        this.accountList = response.data.newlist;
                        this.totalRows = response.data.newlist.length;
                        this.accountDetails = response.data.accountInfo;
                        this.resetFields();
                        swal("Success!", response.data.message, "success");

                    })
                    .catch(err=>{
                        console.log("error", err);
                        swal("Error!", 
                            "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                            "error");
                    });
                }
                else {
                    swal("Error!", "Please fill-in all fields.", "error");
                }

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
                        axios.get('/admin/studentaccount/delete/' + this.accountID + '/' + this.student.id)
                        .then(response => {

                            this.accountList = response.data.newlist;
                            this.totalRows = response.data.newlist.length;
                            this.accountDetails = response.data.accountInfo;
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
            requireAllFields() {
                var self = this
                var check = true;
                Object.keys(self.accountData).forEach(function(key,index) {
                    // console.log('test: ', key + ' | ' + self.accountData[key]);
                    if(self.accountData[key] == '')
                        check = false;
                })

                return check;
            },
            resetFields() {
                this.accountData.payment_status = '';
                this.accountData.payment_type = '';
                this.accountData.payment_date = '';
                this.accountData.remarks = '';
                this.accountData.amount = '';
                this.show = false;
            }
        },
    }
</script>
