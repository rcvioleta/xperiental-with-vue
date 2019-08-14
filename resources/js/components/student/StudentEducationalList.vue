<template>
    <b-container fluid>
        <div class="form-row mb-3">
            <div class="col-lg-6">
                <h2>School Attended</h2>
            </div>
            <div class="col-lg-6">
                <button class="btn btn-primary pull-right mr-0" @click="addForm($event.target)">Add History <i class="batch-icon batch-icon-plus"></i></button>
            </div>
        </div>
        <b-row>
            <b-col>
                <b-table striped hover 
                :items="edu_backgrounds" 
                :fields="fields" 
                :per-page="perPage" 
                :current-page="currentPage"
                :filter="filter"
                @filtered="onFiltered"
                >
                <template slot="action" slot-scope="data">
                    <b-link @click="editForm($event.target, data.item.name, data.item.year_attended, data.item.notes, data.item.id)" class="btn btn-sm btn-warning pull-right waves-effect waves-light btable-button">Edit <i class="fa fa-pencil"></i></b-link>
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
    
    <b-modal :id="'modal_' + infoModal.student_id" :title="modaltitle" :ok-title="okName" @ok="handleOk">
            <b-row>
                <b-col>
                    <b-form-group
                    id="input-group-1"
                    label="School Name"
                    label-for="input-1"
                    >
                    <b-form-input
                    id="input-1"
                    v-model="infoModal.name"
                    ></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="4">
                <b-form-group
                id="input-group-1"
                label="Year Attended"
                label-for="input-1"
                >
                <b-form-input
                id="input-1"
                v-model="infoModal.year_attended"
                ></b-form-input>
            </b-form-group>
        </b-col>
    </b-row>
    <b-row>
        <b-col>
            <b-form-group
            id="input-group-1"
            label="Notes"
            label-for="input-1"
            >
            <b-form-textarea
            id="input-1"
            v-model="infoModal.notes"
            rows="3"
            max-rows="6"
            ></b-form-textarea>
        </b-form-group>
    </b-col>
</b-row>

</b-modal>
</b-container>
</template>

<script>

    export default {
        // props: ['studentId', 'eduBackgrounds'],
        data() {
            return {
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                edu_backgrounds: [],
                totalRows: '',
                filter: null,
                modaltitle: '',
                editId: '',
                okName: '',
                infoModal: {
                    student_id: '',
                    name: '',
                    year_attended: '',
                    notes: '',
                },
                fields: [
                    'name',
                    'year_attended',
                    'notes', 
                    { key: 'action', label: 'Action' }
                ],
            }
        },
        created() {
            Event.$on('studentmanagement-edit', (studentmanagement) => {
                this.infoModal.student_id = studentmanagement.student.id
                this.edu_backgrounds = studentmanagement.eduBackgrounds;
                this.totalRows = studentmanagement.eduBackgrounds.length;
            });
        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            addForm(button) {
                this.modaltitle = 'Add History'
                this.okName = 'Save'

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id, button)
                })
            },
            editForm(button, name, year_attended, notes, educId) {
                this.modaltitle = 'Edit History';
                this.okName = 'Update';
                this.editId = educId;
                this.infoModal.name = name;
                this.infoModal.year_attended = year_attended;
                this.infoModal.notes = notes;

                this.$nextTick(() => {
                    this.$root.$emit('bv::show::modal', 'modal_' + this.infoModal.student_id, button)
                })
            },
            handleOk(bvModalEvt) {
                // bvModalEvt.preventDefault()
                var url = "";

                if(this.okName == 'Save')
                    url = '/admin/educationalbackground/store';
                else if(this.okName == 'Update')
                    url = '/admin/educationalbackground/update/' + this.editId;

                axios.post(url, this.infoModal)
                .then(response => {

                    this.edu_backgrounds = response.data.newlist;
                    swal("Success!", response.data.message, "success");

                    this.resetInfoModal();
                })
                .catch(err=>{
                    console.log("error", err);
                    swal("Error!", 
                        "Looks like something went wrong, please try again. If issue persist, please report this to your system developer.", 
                        "error");
                });

                this.$nextTick(() => {
                    this.$bvModal.hide()
                })
            },
            resetInfoModal() {
                this.modaltitle = ''
                this.infoModal.name = ''
                this.infoModal.year_attended = ''
                this.infoModal.notes = ''
            },
        },
    }
</script>
