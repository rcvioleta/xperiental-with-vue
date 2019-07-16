<template>
    <b-container>
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
                :items="accountData" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage"
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="student_name" slot-scope="data">
                    {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name }}
                </template>
                <template slot="action" slot-scope="data">
                    <a :href="'/admin/studentaccount/edit/' + data.item.id" class="table-button btn-primary btn-sm waves-effect waves-light tableBTN">
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
        props: ['accounts'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                accountData: this.accounts,
                totalRows: this.accounts.length,
                filter: null,
                fields: [
                    { key: 'id_num', label: 'Student ID' },
                    'nickname',
                    'student_name',
                    'credits',
                    'credits_used',
                    'available_credits',
                    'action',
                ],
            }
        },
        created() {

        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
    }
</script>
