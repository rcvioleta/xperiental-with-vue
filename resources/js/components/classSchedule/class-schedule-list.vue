<template>
    <b-container>
        <div class="form-row mb-3">
            <div class="col-lg-6">
                <h2>Class History</h2>
            </div>
        </div>
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
                    {{ data.item.status == 1 ? 'Enabled' : 'Cancelled' }}
                </template>
                <!-- <template slot="action" slot-scope="row">
                    <a class="table-button btn-primary btn-sm waves-effect waves-light" @click="row.toggleDetails">
                        {{ row.detailsShowing ? 'Hide' : 'View'}} <i class="fa fa-eye"></i>
                    </a>
                </template>

                <template slot="row-details" slot-scope="row">
                    <b-card>
                        <b-row class="mb-2">
                            <b-col sm="3" class="text-sm-right"><b>Instructor:</b></b-col>
                            <b-col>{{ row.item.instructor_id }}</b-col>
                        </b-row>
                    </b-card>
                </template> -->

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
        props: ['classSchedules'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                class_schedules: this.classSchedules,
                totalRows: this.classSchedules.length,
                filter: null,
                fields: [
                    'date_start',
                    'date_end', 
                    { key: 'credits', label: 'Credits Spent' },
                    'class_type',
                    'subject',
                    'instructor',
                    'status',
                    // 'action'
                ],
            }
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
    }
</script>
