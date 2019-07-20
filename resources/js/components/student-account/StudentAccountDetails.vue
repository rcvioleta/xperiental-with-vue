<template>
    <b-container>
        <b-row>
            <b-col></b-col>
        </b-row>
        <b-row align-h="between">
            <b-col cols="3" class="pt-3" align="left">
                <b-form-group class="mb-10">
                    <b-form-input v-model="filter" placeholder="Search"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col cols="3">
                <b-form-group class="mb-10" align="right">
                    <button class="btn btn-primary pull-right mr-0" @click="addPayment">Add Payment <i class="batch-icon batch-icon-plus"></i></button>
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
                <template slot="action" slot-scope="data">
                    <button class="table-button btn-warning btn-sm waves-effect waves-light tableBTN">
                        Edit <i class="fa fa-pencil"></i>
                    </button>
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
    <b-modal v-model="show" :id="'modal_' + studentData.id" :title="modaltitle" hide-footer>
        <b-row>
            <b-col>
                <b-form-group label="Amount">
                    <b-form-input v-model="studentData.amount"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Payment Status">
                <b-form-input v-model="studentData.payment_status"></b-form-input>
                </b-form-group>
            </b-col>
            <b-col>
                <b-form-group label="Payment Date">
                    <b-form-input v-model="studentData.payment_date"></b-form-input>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                <b-form-group label="Remarks">
                    <b-form-textarea v-model="studentData.notes" rows="3" max-rows="6"></b-form-textarea>
                </b-form-group>
            </b-col>
        </b-row>
        <b-row>
            <hr>
            <div slot="modal-footer" class="w-100">
                <b-button
                  variant="danger"
                  class="float-left ml-2"
                  @click="deleteForm"
                >
                  DELETE
                </b-button>
                <b-button
                  variant="primary"
                  class="float-right ml-2"
                  @click="handleOk"
                >
                  {{ okName }}
                </b-button>
                <b-button
                  class="float-right ml-2"
                  @click="show=false"
                >
                  CANCEL
                </b-button>
            </div>
        </b-row>
    </b-modal>
</b-container>
</template>

<script>

    export default {
        props: ['accounts', 'student'],
        data() {
            return {
                show: false,
                currentPage: 1,
                perPage: 10,
                pageOptions: [10, 20, 50],
                studentData: this.student,
                accountData: this.accounts,
                totalRows: this.accounts.length,
                filter: null,
                fields: [
                    'payment_date',
                    'amount',
                    'payment_status',
                    'remarks',
                    'action',
                ],
                modaltitle: '',
                okName: '',
            }
        },
        created() {

        },
        methods: {
            onFiltered(filteredItems) {
                this.totalRows = filteredItems.length
                this.currentPage = 1
            },
            addPayment() {
                this.show = true;
            }
        },
    }
</script>
