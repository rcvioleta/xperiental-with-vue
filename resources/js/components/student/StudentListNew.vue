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
                :items="studentData" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage"
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="student_name" slot-scope="data">
                    {{ data.item.first_name }} {{ data.item.middle_name }} {{ data.item.last_name }}
                </template>
                <template slot="available_credits" slot-scope="data">
                    {{ isNaN(data.item.credits - data.item.credits_used) ? '' : (data.item.credits - data.item.credits_used) }}
                </template>
                <template slot="action" slot-scope="data">
                    <a :href="'/admin/studentmanagement/' + data.item.id + '/edit'" class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button">
                        Edit <i class="fa fa-pencil"></i>
                    </a>
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
    import 'bootstrap-vue/dist/bootstrap-vue.css'

    export default {
        props: ['students'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                creditUsed: this.students[0].credits_used,
                studentData: this.students[0].student,
                totalRows: this.students[0].student.length,
                filter: null,
                fields: [
                    { key: 'id_num', label: 'Student ID' },
                    'student_name',
                    'credits',
                    'credits_used',
                    'available_credits',
                    { key: 'created_at', label: 'Created On' },
                    'action',
                ],
            }
        },
        created() {
            var res = this.studentData.map(x => Object.assign(x, this.creditUsed.find(y => y.student_id == x.id)));
            console.log('Hey: ', res);
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            }
        },
    }
</script>
