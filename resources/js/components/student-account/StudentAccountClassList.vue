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
                :items="class_schedules" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage"
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="instructor" slot-scope="data">
                    {{ data.item.first_name }} {{ data.item.middle_name }} {{ data.item.last_name }}
                </template>
                <template slot="status" slot-scope="data">
                    {{ data.item.status == 1 ? 'Active' : 'Inactive' }}
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
        // props: ['classschedules'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                class_schedules: [],
                totalRows: '',
                filter: null,
                fields: [
                    'date_start',
                    'date_end', 
                    { key: 'credits', label: 'Credits Spent' },
                    'class_type',
                    'subject',
                    'instructor',
                    'status',
                ],
            }
        },
        created() {
            Event.$on('studentaccount-edit', (studentaccount) => {
                this.class_schedules = studentaccount.classSchedules;
                this.totalRows = studentaccount.classSchedules.length;
            });
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
    }
</script>
