<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Student Account List</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <ul class="nav nav-tabs custom-tab-headers" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1" data-toggle="tab" role="tab" aria-controls="tab_1" aria-selected="true">Monthly Payment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_2" data-toggle="tab" role="tab" aria-controls="tab_2" aria-selected="false">Registration Fee</a>
                    </li>
                </ul>
                <b-card>
                    <div class="tab-content" id="student-account-details-tab">
                        <div id="tab_1" class="row tab-pane fade show active p-3 pb-0" role="tabpanel" aria-labelledby="tab_1">
                            <b-row align-h="between">
                                <b-col cols="6" align="start">
                                    <b-form-group class="mb-10 mr-5 float-left">
                                        <label>Show:</label>
                                        <b-form-select 
                                        v-model="perPage_mp" 
                                        :options="pageOptions" 
                                        style="width: 60px">
                                        </b-form-select>
                                    </b-form-group>
                                </b-col>
                                <b-col cols="6" align="right">
                                    <b-form-group label-cols-sm="3" class="mb-10">
                                        <b-form-input v-model="filter_mp" placeholder="Search"></b-form-input>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <b-table striped hover 
                                    :items="studentData" 
                                    :fields="fields_mp" 
                                    :per-page="perPage_mp" 
                                    :current-page="currentPage_mp" 
                                    :filter="filter_mp"
                                    @filtered="onFiltered_mp">
                                        <template slot="student_name" slot-scope="data">
                                            {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name }}
                                        </template>
                                        <template slot="balance" slot-scope="data">
                                            <span v-if="(data.item.payment - data.item.credit_cost) < 0" style="color: red; font-weight: bold;">
                                                {{ formatPrice(data.item.payment - data.item.credit_cost) }}
                                            </span>
                                            <span v-else style="font-weight: bold;">
                                                0
                                            </span>
                                            <!-- <span v-if="(data.item.payment - data.item.credit_cost) > 0" style="color: green;font-weight: bold;">
                                                (+){{ data.item.payment - data.item.credit_cost }}
                                            </span>
                                            <span v-else-if="(data.item.payment - data.item.credit_cost) == 0" style="color:green;font-weight: bold;">
                                                {{ data.item.payment - data.item.credit_cost }}
                                            </span>
                                            <span v-else-if="isNaN(data.item.payment - data.item.credit_cost)">
                                            </span>
                                            <span v-else style="color: red;font-weight: bold;">
                                                {{ data.item.payment - data.item.credit_cost }}
                                            </span> -->
                                        </template>
                                        <template slot="credits" slot-scope="data">
                                            <span v-if="(data.item.payment - data.item.credit_cost) > 0" style="color: green; font-weight: bold;">
                                                {{ formatPrice(data.item.payment - data.item.credit_cost) }}
                                            </span>
                                            <span v-else style="font-weight: bold;">
                                                0
                                            </span>
                                        </template>
                                        <template slot="action" slot-scope="data">
                                            <router-link :to="'/studentaccount/edit/' + data.item.student_id" 
                                            class="btn btn-sm btn-primary pull-right waves-effect waves-light btable-button" 
                                            style="color: white !important;">
                                                View <i class="fa fa-eye"></i>
                                            </router-link>
                                        </template>

                                    </b-table>
                                </b-col>
                            </b-row>
                            <b-row align-h="between">
                                <b-col cols="3">
                                    Total Entries: {{ totalRows_mp }}
                                </b-col>
                                <b-col>
                                    <b-pagination 
                                    v-model="currentPage_mp" 
                                    :total-rows="totalRows_mp" 
                                    :per-page="perPage_mp" 
                                    align="right">
                                    </b-pagination>
                                </b-col>
                            </b-row>
                        </div>
                        <div id="tab_2" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_2">
                            <b-row align-h="between">
                                <b-col cols="6" align="start">
                                    <b-form-group class="mb-10 mr-5 float-left">
                                        <label>Show:</label>
                                        <b-form-select 
                                        v-model="perPage_rf" 
                                        :options="pageOptions" 
                                        style="width: 60px">
                                        </b-form-select>
                                    </b-form-group>
                                </b-col>
                                <b-col cols="6" align="right">
                                    <b-form-group label-cols-sm="3" class="mb-10">
                                        <b-form-input v-model="filter_rf" placeholder="Search"></b-form-input>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <b-table striped hover 
                                    :items="studentData" 
                                    :fields="fields_rf" 
                                    :per-page="perPage_rf" 
                                    :current-page="currentPage_rf" 
                                    :filter="filter_rf"
                                    @filtered="onFiltered_rf">
                                        <template slot="student_name" slot-scope="data">
                                            {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name }}
                                        </template>
                                        <template slot="annual_fee" slot-scope="data">
                                            <span v-if="data.item.annual_fee < 11" style="color:green;font-weight:bold;">
                                                Active
                                            </span>
                                            <span v-else-if="data.item.annual_fee == 11" style="color:orange;font-weight:bold;">
                                                For Renewal
                                            </span>
                                            <span v-else style="color:red;font-weight:bold;">
                                                Inactive
                                            </span>
                                        </template>
                                        <template slot="action" slot-scope="data">
                                            <router-link :to="'/studentaccount/edit/registration/' + data.item.student_id" 
                                            class="btn btn-sm btn-primary pull-right waves-effect waves-light btable-button" 
                                            style="color: white !important;">
                                                View <i class="fa fa-eye"></i>
                                            </router-link>
                                        </template>

                                    </b-table>
                                </b-col>
                            </b-row>
                            <b-row align-h="between">
                                <b-col cols="3">
                                    Total Entries: {{ totalRows_rf }}
                                </b-col>
                                <b-col>
                                    <b-pagination 
                                    v-model="currentPage_rf" 
                                    :total-rows="totalRows_rf" 
                                    :per-page="perPage_rf" 
                                    align="right">
                                    </b-pagination>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        data() {
            return {
                pageOptions: [10, 20, 50],
                currentPage_mp: 1,
                perPage_mp: 10,
                studentData: [],
                totalRows_mp: '',
                filter_mp: null,
                fields_mp: [
                    { key: 'id_num', label: 'Student ID' },
                    'nickname',
                    'student_name',
                    'balance',
                    'credits',
                    'action',
                ],

                currentPage_rf: 1,
                perPage_rf: 10,
                totalRows_rf: '',
                filter_rf: null,
                fields_rf: [
                    { key: 'id_num', label: 'Student ID' },
                    'nickname',
                    'student_name',
                    { key: 'annual_fee', label: 'Registration Fee' },
                    'action',
                ],
            }
        },
        created() {
            axios.get('/admin/studentaccount/')
            .then(response => {
                
                this.studentData = response.data.accounts;
                this.totalRows_mp = response.data.accounts.length;
                this.totalRows_rf = response.data.accounts.length;

                var res = this.studentData.map(x => Object.assign(x, response.data.payment.find(y => y.student_id == x.student_id)));
                var res2 = this.studentData.map(x => Object.assign(x, response.data.annual_fee.find(y => y.student_id == x.student_id)));
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
        methods: {
            onFiltered_mp(filteredItems) {
                this.totalRows_mp = filteredItems.length
                this.currentPage_mp = 1
            },
            onFiltered_rf(filteredItems) {
                this.totalRows_rf = filteredItems.length
                this.currentPage_rf = 1
            },
            formatPrice(value) {
                // let val = (value/1).toFixed(2).replace(',', '.')
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
            },
        },
    }
</script>
