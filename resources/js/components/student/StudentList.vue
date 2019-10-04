<template>
    <b-container fluid>
        <b-row>
            <b-col cols="6">
                <h1>Student List</h1>
            </b-col>
            <b-col cols="6">
                <router-link class="btn btn-primary pull-right" to="studentmanagement/create">Add New <i class="ml-2 batch-icon batch-icon-plus"></i></router-link>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <ul class="nav nav-tabs custom-tab-headers" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab_1" data-toggle="tab" role="tab" aria-controls="tab_1" aria-selected="true">Active Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab_2" data-toggle="tab" role="tab" aria-controls="tab_2" aria-selected="false">Inactive Students</a>
                    </li>
                </ul>
                <b-card>
                    <div class="tab-content" id="student-account-details-tab">
                        <div id="tab_1" class="row tab-pane fade show active p-3 pb-0" role="tabpanel" aria-labelledby="tab_1">
                            <b-row align-h="between">
                                <b-col cols="3">
                                    <b-form-group class="mb-10" align="start">
                                        <label>Show:</label>
                                        <b-form-select 
                                        v-model="perPage_active" 
                                        :options="pageOptions" 
                                        style="width: 60px">
                                        </b-form-select>
                                    </b-form-group>
                                </b-col>
                                <b-col cols="4" align="right">
                                    <b-form-group label-cols-sm="3" class="mb-10">
                                        <b-form-input v-model="filter_active" placeholder="Search"></b-form-input>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <b-table striped hover 
                                    :items="studentData_active" 
                                    :fields="fields" 
                                    :per-page="perPage_active" 
                                    :current-page="currentPage_active" 
                                    :filter="filter_active" 
                                    @filtered="onFilteredActive">
                                        <template slot="student_name" slot-scope="data">
                                            {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name == 'null'? '': data.item.middle_name }}
                                        </template>
                                        <template slot="action" slot-scope="data">
                                            <router-link :to="'/studentmanagement/edit/' + data.item.id" class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button">
                                                Edit <i class="fa fa-pencil"></i>
                                            </router-link>
                                        </template>
                                    </b-table>
                                </b-col>
                            </b-row>
                            <b-row align-h="between">
                                <b-col cols="3">
                                    Total Entries: {{ totalRows_active }}
                                </b-col>
                                <b-col>
                                    <b-pagination 
                                    v-model="currentPage_active" 
                                    :total-rows="totalRows_active" 
                                    :per-page="perPage_active" 
                                    align="right">
                                    </b-pagination>
                                </b-col>
                            </b-row>
                        </div>
                        <div id="tab_2" class="row tab-pane fade p-3 pb-0" role="tabpanel" aria-labelledby="tab_2">
                            <b-row align-h="between">
                                <b-col cols="3">
                                    <b-form-group class="mb-10" align="start">
                                        <label>Show:</label>
                                        <b-form-select 
                                        v-model="perPage_inactive" 
                                        :options="pageOptions" 
                                        style="width: 60px">
                                        </b-form-select>
                                    </b-form-group>
                                </b-col>
                                <b-col cols="4" align="right">
                                    <b-form-group label-cols-sm="3" class="mb-10">
                                        <b-form-input v-model="filter_inactive" placeholder="Search"></b-form-input>
                                    </b-form-group>
                                </b-col>
                            </b-row>
                            <b-row>
                                <b-col>
                                    <b-table striped hover 
                                    :items="studentData_inactive" 
                                    :fields="fields" 
                                    :per-page="perPage_active" 
                                    :current-page="currentPage_inactive" 
                                    :filter="filter_inactive" 
                                    @filtered="onFilteredInactive">
                                        <template slot="student_name" slot-scope="data">
                                            {{ data.item.last_name }}, {{ data.item.first_name }} {{ data.item.middle_name }}
                                        </template>
                                        <template slot="action" slot-scope="data">
                                            <router-link :to="'/studentmanagement/edit/' + data.item.id" class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button">
                                                Edit <i class="fa fa-pencil"></i>
                                            </router-link>
                                        </template>
                                    </b-table>
                                </b-col>
                            </b-row>
                            <b-row align-h="between">
                                <b-col cols="3">
                                    Total Entries: {{ totalRows_inactive }}
                                </b-col>
                                <b-col>
                                    <b-pagination 
                                    v-model="currentPage_inactive" 
                                    :total-rows="totalRows_inactive" 
                                    :per-page="perPage_inactive" 
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
                currentPage_active: 1,
                perPage_active: 10,    
                studentData_active: [],
                totalRows_active: '',
                filter_active: null,

                currentPage_inactive: 1,
                perPage_inactive: 10,    
                studentData_inactive: [],
                totalRows_inactive: '',
                filter_inactive: null,

                pageOptions: [10, 20, 50],
                fields: [
                    { key: 'id_num', label: 'Student ID' },
                    'nickname',
                    'student_name',
                    'birth_date',
                    'gender',
                    { key: 'registration_date', label: 'Registration Date' },
                    'action',
                ],
            }
        },
        created() {
            axios.get('/admin/studentmanagement/')
            .then(response => {
                this.studentData_active = response.data.active;
                this.totalRows_active = response.data.active.length;

                this.studentData_inactive = response.data.inactive;
                this.totalRows_inactive = response.data.inactive.length;
            })
            .catch(err=>{
                swal("Error!", 
                    "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                    "error");
            });
        },
        methods: {
            onFilteredActive(filteredItems) {
                this.totalRows_active = filteredItems.length
                this.currentPage_active = 1
            },
            onFilteredInactive(filteredItems) {
                this.totalRows_inactive = filteredItems.length
                this.currentPage_inactive = 1
            }
        },
    }
</script>
