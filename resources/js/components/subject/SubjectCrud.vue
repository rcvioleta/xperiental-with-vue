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

    <div class="backdrop" :class="isActive"></div>
    <div class="main-modal" :class="isActive">
      <div class="card">
        <div class="card-header">Edit</div>
        <div class="card-body">
          <form @submit.prevent="update">
            <div class="form-group">
              <input type="hidden" name="subject_slug" :value="selectedSubject.slug">
              <label for="subject">Subject Name</label>
              <input
                type="text"
                id="subject"
                name="subject_name"
                class="form-control"
                placeholder="Subject Name"
                :value="selectedSubject.name"
              >
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="new_status" id="status" class="form-control">
                <option
                  :value="selectedSubject.status ? 1 : 0"
                >{{ selectedSubject.status ? 'Active' : 'Inactive' }}</option>
                <option
                  :value="selectedSubject.status ? 0 : 1"
                >{{ selectedSubject.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
            <button class="btn btn-primary" type="submit">Update Subject</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

// class to perform CRUD for subjects
import Subject from "../../helpers/Subject.js";
import { EventBus } from "../../app.js";

export default {
  data() {
    return {
      subjects: [],
      selectedSubject: "",
      editingMode: false,
      subjectIndex: ""
    };
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
      Subject.update(payload, result => {
        console.log("[updateStatus] result", result);
        swal("Success!", "Successfull updated subject", "success");
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
          Subject.delete(slug, removedSlug => {
            this.subjects.data = this.subjects.data.filter(
              subject => subject.slug !== removedSlug
            );
          });
        } else {
          swal("Subject was kept");
        }
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
      const subjectName = e.target.subject_name.value;
      const slug = e.target.subject_slug.value;
      const status = e.target.new_status.value;
      const payload = {
        name: subjectName,
        slug: slug,
        status: status
      };

      Subject.update(payload, update => {
        /**
         * update the frontend data with the data response from the server,
         * instead of making another http request
         */
        this.subjects.data[this.subjectIndex] = update;
        this.editingMode = false;
        console.log("[updateStatus] result", update);
        swal("Success!", "Successfull updated subject", "success");
      });
    },
    fetchSubjects() {
      Subject.getSubjects(subjects => (this.subjects = subjects));
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

<style>
.main-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 80%;
  transform: translate(-50%, -50%);
  z-index: 700;
  display: none;
}

.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 600;
  background: rgba(0, 0, 0, 0.7);
  display: none;
}

.main-modal.in-use,
.backdrop.in-use {
  display: block;
}

@media (min-width: 48em) {
  .main-modal {
    width: 30%;
  }
}
</style>
