<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Employee List</h1>
            </b-col>
            <b-col cols="6">
                <router-link class="btn btn-primary pull-right" to="/instructor/create">Add New <i class="ml-2 batch-icon batch-icon-plus"></i></router-link>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-card>
                    <b-row align-h="between">
                        <b-col cols="3">
                            <b-form-group class="mb-10" align="start">
                                <label>Show:</label>
                                <b-form-select 
                                v-model="perPage" 
                                :options="pageOptions" 
                                style="width: 60px">
                                </b-form-select>
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
                            :items="instructorData" 
                            :fields="fields" 
                            :per-page="perPage" 
                            :current-page="currentPage" 
                            :filter="filter" 
                            @filtered="onFiltered">
                                <template slot="instructor_name" slot-scope="data">
                                    {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name == 'null'? '' : data.item.middle_name }}
                                </template>
                                <template slot="status" slot-scope="data">
                                    <span class="badge badge-success" v-if="data.item.status == 1">Active</span>
                                    <span class="badge badge-danger" v-else>Inactive</span>
                                </template>
                                <template slot="action" slot-scope="data">
                                    <router-link :to="'/instructor/edit/' + data.item.id" class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button">
                                        Edit <i class="fa fa-pencil"></i>
                                    </router-link>
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
                            align="right">
                            </b-pagination>
                        </b-col>
                    </b-row>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
    export default {
        // props: ['instructors'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                instructorData: [],
                totalRows: '',
                filter: null,
                fields: [
                    { key: 'id_num', label: 'Instructor ID' },
                    'nickname',
                    'instructor_name',
                    'hired_date',
                    'status',
                    'action',
                ],
            }
        },
        created() {
            axios.get('/admin/instructor/')
            .then(response => {
                this.instructorData = response.data;
                this.totalRows = response.data.length;
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
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
