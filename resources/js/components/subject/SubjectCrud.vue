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
                class="btn btn-primary btn-sm dropdown-toggle"
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
import Model from "../../helpers/Model.js";
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
    this.fetchSubjects();

    EventBus.$on("newSubjectAdded", result => {
      this.subjects.data.push(result);
      swal("Congrats!", "New subject added", "success");
    });

    EventBus.$on("closeModalEvent", () => {
      this.editingMode = false;
    });
  },
  methods: {
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
      this.subjectIndex = this.subjects.data.findIndex(
        subject => subject.slug === slug
      );
      this.selectedSubject = this.subjects.data[this.subjectIndex];
      this.editingMode = true;
    },
    update(e) {
      const target = e.target;
      const name = target.name.value;
      const slug = target.slug.value;
      const status = target.status.value;
      const uri = `subject/${slug}`;
      const payloads = { name, slug: name, status };

      Model.update(uri, payloads, (err, update) => {
        if (!err) {
          const updatedSubject = { ...this.subjects };
          updatedSubject.data[this.subjectIndex] = update;
          this.subjects = { ...updatedSubject };
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
      Model.fetchAll("subject", (err, data) => {
        if (!err) this.subjects = data;
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