<template>
    <b-container fluid>
        <b-row align-h="between">
            <b-col cols="3">
                <b-form-group class="mb-10" align="start">
                    <label>Show:</label>
                    <b-form-select v-model="perPage" :options="pageOptions" style="width: 60px"></b-form-select>
                </b-form-group>
            </b-col>
            <b-col cols="4" align="right">
                <b-form-group label-cols-sm="3" class="mb-10">
                    <b-form-input v-model="filter" placeholder="Search"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-table striped hover 
                :items="studentData" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage"
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="student_name" slot-scope="data">
                    {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name }}
                </template>
                <!-- <template slot="available_credits" slot-scope="data">
                    {{ isNaN(data.item.credits - data.item.credits_used) ? '' : (data.item.credits - data.item.credits_used) }}
                </template> -->
                <template slot="balance" slot-scope="data">
                    <span v-if="(data.item.payment - data.item.credit_cost) > 0" style="color: green;">
                        (+){{ data.item.payment - data.item.credit_cost }}
                    </span>
                    <span v-else-if="(data.item.payment - data.item.credit_cost) == 0" style="color: green;">
                        {{ data.item.payment - data.item.credit_cost }}
                    </span>
                    <span v-else-if="isNaN(data.item.payment - data.item.credit_cost)">
                        
                    </span>
                    <span v-else style="color: red;">
                        {{ data.item.payment - data.item.credit_cost }}
                    </span>

                </template>
                <template slot="action" slot-scope="data">
                    <a :href="'/admin/studentaccount/edit/' + data.item.student_id" class="btn btn-sm btn-primary pull-right waves-effect waves-light btable-button" style="color: white !important;">
                        View <i class="fa fa-eye"></i>
                    </a>
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
</b-container>
</template>

<script>

    export default {
        props: ['data'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                payment: this.data.payment,
                studentData: this.data.accounts,
                totalRows: this.data.accounts.length,
                filter: null,
                fields: [
                    { key: 'id_num', label: 'Student ID' },
                    'nickname',
                    'student_name',
                    'balance',
                    'action',
                ],
            }
        },
        created() {
            var res = this.studentData.map(x => Object.assign(x, this.payment.find(y => y.student_id == x.student_id)));
            // console.log('Hey: ', res);
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
    }
</script>
