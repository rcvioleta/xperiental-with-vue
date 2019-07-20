<template>
  <div id="subject">
        <!-- start search and show functionality -->
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
          <!-- end search and show functionality -->
          <!-- start new table -->
          <b-row>
            <b-col>
              <b-table striped hover 
              :items="subjects.data" 
              :fields="fields" 
              :per-page="perPage" 
              :current-page="currentPage"
              :filter="filter"
              @filtered="onFiltered"
              >
              <template slot="status" slot-scope="data">
                <div class="btn-group">
                  <select class="btn btn-primary btn-sm dropdown-toggle" name="status"
                    v-model="data.item.status"
                    @change="updateStatus($event, data.item.slug)"
                    >
                    <option :value="data.item.status ? 1 : 0">{{ data.item.status ? 'Active' : 'Inactive' }}</option>
                    <option :value="data.item.status ? 0 : 1">{{ data.item.status ? 'Inactive' : 'Active' }}</option>
                  </select>
                </div>
              </template>
              <template slot="action" slot-scope="data">
                <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                  <button type="button" class="btn btn-danger" @click="deleteSubject(data.item.slug)">Remove</button>
                  <button type="button" class="btn btn-warning" @click="editSubject(data.item.slug)">Edit</button>
                </div>
              </template>
            </b-table>
          </b-col>
        </b-row>
        <!-- end new table -->
        <!-- start total count -->
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
        <!-- end total count -->
    </div>
  </template>

  <script>
    import Model from "../../../helpers/Model.js";
    import { EventBus } from "../../../app.js";

    export default {
      data() {
        return {
          // start declared variables
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
          // end declared variables
          subjects: [],
          index: ""
        };
      },
      created() {
        this.fetchSubjects();

        EventBus.$on("editingSubjectOk", () => {
          this.fetchSubjects();
        });

        EventBus.$on("newSubjectAdded", result => {
          this.subjects.data.push(result);
          this.totalRows = this.subjects.data.length;
          swal("Congrats!", "New subject added", "success");
        });
      },
      methods: {
        // start search table
        onFiltered(filteredItems) {
          this.totalRows = filteredItems.length
          this.currentPage = 1
        },
        // end search table
        updateStatus(e, slug) {
          const status = Number(e.target.value);
          let uri = "";

          if (status === 1) uri = `subject/active/${slug}`;
          else uri = `subject/inactive/${slug}`;

          Model.updateStatus(uri, (err, update) => {
            if (!err) {
              swal("Congrats!", update.message, "success");
              console.log("update status", update);
            } else {
              console.log("error updating status", err);
              swal(
                "Sorry... Something went wrong :(",
                "Unable to update subject status",
                "error"
                );
            }
          });
        },
        deleteSubject(slug) {
          swal({
            title: "Continue removing this subject?",
            text: "There's no going back!",
            icon: "warning",
            buttons: true,
            dangerMode: true
          }).then(willDelete => {
            if (willDelete) {
              Model.delete(`subject/${slug}`, (err, removedSlug) => {
                if (!err) {
                  this.subjects.data = this.subjects.data.filter(
                    subject => subject.slug !== removedSlug
                    );
                  swal("Subject was removed!", { icon: "success" });
                  console.log("DELETE RESULT", removedSlug);
                } else {
                  swal(
                    "Something went wrong",
                    `Unable to delete subject. \n ${err.message}`,
                    "error"
                    );
                  console.log("[DELETE ERROR]", err.response);
                }
              });
            } else swal("Subject was kept");
          });
        },
        editSubject(slug) {
          console.log("EDIT SUBJECT", slug);
          this.index = this.subjects.data.findIndex(
            subject => subject.slug === slug
            );
          const data = {...this.subjects.data[this.index]};
          const payloads = { editing: true, data };
          EventBus.$emit("editingSubject", payloads);
        },
        fetchSubjects() {
          Model.fetchAll("subject", (err, data) => {
            if (!err) this.subjects = data;
            else {
              console.log("[FETCH SUBJECTS ERROR]", err.response);
              swal("Something went wrong", "Unable to fetch subjects", "error");
            }
          });
        }
      }
    };
  </script>