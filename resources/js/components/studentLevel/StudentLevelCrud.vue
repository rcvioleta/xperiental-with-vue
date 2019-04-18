<template>
  <div id="student-level">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="studentLevel in studentLevels.data" :key="studentLevel.slug">
          <td>{{ studentLevel.name }}</td>
          <td>
            <div class="btn-group">
              <select
                class="btn btn-primary btn-sm dropdown-toggle"
                name="status"
                v-model="studentLevel.status"
                @change="updateStatus($event, studentLevel.slug)"
              >
                <option
                  :value="studentLevel.status ? 1 : 0"
                >{{ studentLevel.status ? 'Active' : 'Inactive' }}</option>
                <option
                  :value="studentLevel.status ? 0 : 1"
                >{{ studentLevel.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button
                type="button"
                class="btn btn-danger"
                @click="deleteStudentLevel(studentLevel.slug)"
              >Remove</button>
              <button
                type="button"
                class="btn btn-warning"
                @click="editStudentLevel(studentLevel.slug)"
              >Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <level-modal
      :active="isActive"
      :name="selectedLevel.name"
      :status="selectedLevel.status"
      :slug="selectedLevel.slug"
      :updateFunc="update"
    ></level-modal>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import Model from "../../helpers/Model.js";
import Modal from "../ui/modal/Modal.vue";

export default {
  data() {
    return {
      studentLevels: "",
      selectedLevel: "",
      levelIndex: "",
      editingMode: false
    };
  },
  components: {
    "level-modal": Modal
  },
  created() {
    Model.fetchAll("student-level", (err, response) => {
      if (!err) {
        this.studentLevels = response;
      } else {
        swal("Something went wrong", "Unable to fetch Student Levels", "error");
        console.log("getStudentLevels Error:", err.response);
      }
    });

    EventBus.$on("newLevelAdded", result => {
      this.studentLevels.data.push(result);
      swal("Congrats!", "New student level added", "success");
    });
  },
  methods: {
    updateStatus(e, slug) {
      const status = Number(e.target.value);
      let uri = "";

      if (status === 1) uri = `student-level/active/${slug}`;
      else uri = `student-level/inactive/${slug}`;

      Model.updateStatus(uri, (err, result) => {
        if (!err) {
          console.log("update status", result);
          swal("Congrats!", result, "success");
        } else {
          console.log("error updating status", err.response.data);
          swal(
            "Sorry... Something went wrong :(",
            "Unable to update student level status",
            "error"
          );
        }
      });
    },
    deleteStudentLevel(slug) {
      swal({
        title: "Continue removing this level?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          Model.delete("student-level/", slug, (err, removedSlug) => {
            if (!err) {
              this.studentLevels.data = this.studentLevels.data.filter(
                level => level.slug !== removedSlug
              );
              swal("Student Level was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedSlug);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete Student Level. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("Student Level was kept");
      });
    },
    update(e) {
      const level_name = e.target.name.value;
      const slug = e.target.slug.value;
      const status = e.target.status.value;
      const payload = { name: level_name, slug: slug, status: status };

      Model.update("student-level/", payload, (err, update) => {
        if (!err) {
          this.studentLevels.data[this.levelIndex] = update;
          this.editingMode = false;
          console.log("[update] result", update);
          swal("Success!", "Successfully updated level", "success");
        } else {
          swal("Something went wrong", "Unable to update level", "error");
          console.log("[update] error", err.response);
        }
      });
    },
    editStudentLevel(slug) {
      console.log("EDIT SUBJECT", slug);
      this.levelIndex = this.studentLevels.data.findIndex(
        level => level.slug === slug
      );

      this.selectedLevel = this.studentLevels.data[this.levelIndex];
      this.editingMode = true;
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
</style>
