<template>
  <div id="subject">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="subject in subjects.data" :key="subject.slug">
          <td>{{ subject.name }}</td>
          <td>
            <div class="btn-group">
              <select
                name="status"
                v-model="subject.status"
                @change="updateStatus($event, subject.slug, subject.name)"
              >
                <option :value="subject.status ? 1 : 0">{{ subject.status ? 'Active' : 'Inactive' }}</option>
                <option :value="subject.status ? 0 : 1">{{ subject.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button
                type="button"
                class="btn btn-danger"
                @click="deleteSubject(subject.slug)"
              >Remove</button>
              <button type="button" class="btn btn-warning" @click="editSubject(subject.slug)">Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <subject-modal
      :active="isActive"
      :name="selectedSubject.name"
      :status="selectedSubject.status"
      :slug="selectedSubject.slug"
      :updateFunc="update"
    ></subject-modal>
  </div>
</template>

<script>
import axios from "axios";

// class to perform CRUD for subjects
import Subject from "../../helpers/Subject.js";
import GlobalQuery from "../../helpers/GlobalQuery.js";
import { EventBus } from "../../app.js";

import Modal from "../ui/modal/Modal.vue";

export default {
  data() {
    return {
      subjects: [],
      selectedSubject: "",
      editingMode: false,
      subjectIndex: ""
    };
  },
  components: {
    "subject-modal": Modal
  },
  created() {
    // fetch all subjects from database
    this.fetchSubjects();

    // listen to events from AddSubject.vue and check if new subject is added
    EventBus.$on("newSubjectAdded", result => {
      this.subjects.data.push(result);
      swal("Congrats!", "New subject added", "success");
      // console.log("EVENT BUS [SUBJECT CRUD]", result);
    });
  },
  methods: {
    updateStatus(e, slug, subject) {
      const newStatus = e.target.value;
      const payload = {
        name: subject,
        slug: slug,
        status: newStatus
      };
      Subject.update(payload, (err, result) => {
        if (!err) {
          swal("Success!", "Successfull updated subject", "success");
          console.log("[updateStatus] result", result);
        } else {
          swal("Something went wrong", "Unable to update subject", "error");
          console.log("[UPDATE ERROR]", err.message);
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
          Subject.delete(slug, (err, removedSlug) => {
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
      /**
       * get the index of current subject to be edit
       * it will be used to update the frontend data once update is successful
       */
      this.subjectIndex = this.subjects.data.findIndex(
        subject => subject.slug === slug
      );

      /**
       * store selected object for edit, modal is binding to this data
       * and responsible for displaying it
       */
      this.selectedSubject = this.subjects.data[this.subjectIndex];

      // set editing mode to true to bring up the modal
      this.editingMode = true;
    },
    update(e) {
      // console.log(this.subjects.data[this.subjectIndex]);
      const subjectName = e.target.name.value;
      const slug = e.target.slug.value;
      const status = e.target.status.value;
      const payload = { name: subjectName, slug: slug, status: status };

      Subject.update(payload, (err, update) => {
        if (!err) {
          this.subjects.data[this.subjectIndex] = update;
          this.editingMode = false;
          console.log("[updateStatus] result", update);
          swal("Success!", "Successfull updated subject", "success");
        } else {
          swal("Something went wrong", "Unable to update subject", "err");
          console.log("[updateStatus] error", err.response);
        }
      });
    },
    fetchSubjects() {
      GlobalQuery.fetchAll("subject", (err, subjects) => {
        if (!err) this.subjects = subjects;
        else {
          console.log("[FETCH SUBJECTS ERROR]", err.response);
          swal("Something went wrong", "Unable to fetch subjects", "error");
        }
      });
    }
  },
  computed: {
    isActive() {
      return {
        "in-use": this.editingMode
      };
    }
  }
};
</script>