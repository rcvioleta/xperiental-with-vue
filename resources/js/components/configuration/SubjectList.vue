<template>
    <div id="subject">
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
                :items="subjects" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage" 
                :filter="filter" 
                @filtered="onFiltered"
                >
                    <template slot="status" slot-scope="data">
                        <span v-if="data.item.status == 1" class="badge badge-success">Active</span>
                        <span v-else class="badge badge-danger">Inactive</span>
                    </template>
                    <template slot="action" slot-scope="data">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                            <button type="button" class="btn btn-danger" @click="deleteSubject(data.item.slug)">Remove</button>
                            <button type="button" class="btn btn-warning" @click="openModal('tab_1', data.item)">Edit</button>
                        </div>
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
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                totalRows: 0,
                filter: null,
                fields: [
                    'name',
                    { key: 'status', label: 'Status' },
                    { key: 'action', label: 'Action' }
                ],
                subjects: [],
                index: ""
            };
        },
        created() {
            Event.$on('configuration-subject-list', (configuration) => {
                this.subjects = configuration;
                this.totalRows = configuration.length;
            });
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            openModal(type, data) { 
                var items = {
                    'type': type,
                    'data': data
                }
                Event.$emit('configuration-modal', items);
            }
        }
    }
</script>