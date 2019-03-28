<template>
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
              @change="updateStatus($event, subject.slug)"
            >
              <option :value="subject.status ? 1 : 0">{{ subject.status ? 'Active' : 'Inactive' }}</option>
              <option :value="subject.status ? 0 : 1">{{ subject.status ? 'Inactive' : 'Active' }}</option>
            </select>
          </div>
        </td>
        <td>
          <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
            <button type="button" class="btn btn-danger" @click="deleteSubject(subject.slug)">Remove</button>
            <button type="button" class="btn btn-warning">Edit</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
import axios from "axios";

// class to perform CRUD for subjects
import Subject from "../../helpers/Subject.js";
import { EventBus } from "../../app.js";

export default {
  data() {
    return {
      subjects: []
    };
  },
  created() {
    // fetch all subjects from database
    Subject.getSubjects(subjects => (this.subjects = subjects));

    // listen to events from AddSubject.vue and check if new subject is added
    EventBus.$on("newSubjectAdded", result => {
      this.subjects.data.push(result);
      swal("Congrats!", "New subject added", "success");
      // console.log("EVENT BUS [SUBJECT CRUD]", result);
    });
  },
  methods: {
    updateStatus(e, slug) {
      const newStatus = e.target.value;
      const selectedSlug = slug;
      Subject.update(selectedSlug, newStatus);
    },
    deleteSubject(slug) {
      swal({
        title: `Are you sure you want to remove this subject?`,
        text: "Once deleted, you will not be able to retrieve this subject!",
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
    }
  }
};
</script>

<style>
</style>
