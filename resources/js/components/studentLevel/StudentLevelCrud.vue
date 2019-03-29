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
          <td>{{ studentLevel.level_name }}</td>
          <td>
            <div class="btn-group">
              <select
                name="status"
                v-model="studentLevel.status"
                @change="updateStatus($event, studentLevel.slug, studentLevel.level_name)"
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
      :name="selectedLevel.level_name"
      :status="selectedLevel.status"
      :slug="selectedLevel.slug"
      :updateFunc="update"
    ></level-modal>
  </div>
</template>

<script>
import StudentLevel from "../../helpers/StudentLevel.js";
import GlobalQuery from "../../helpers/GlobalQuery.js";
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
    console.log("Created");
    GlobalQuery.fetchAll("student-level", (err, response) => {
      if (!err) {
        this.studentLevels = response;
      } else {
        swal("Something went wrong", "Unable to fetch Student Levels", "error");
        console.log("getStudentLevels Error:", err.response);
      }
    });
  },
  methods: {
    updateStatus(e, slug, levelName) {
      const newStatus = e.target.value;
      const payload = {
        level_name: levelName,
        slug: slug,
        status: newStatus
      };
      StudentLevel.update(payload, (err, result) => {
        if (!err) {
          swal("Success!", "Successfull updated Student Level", "success");
          console.log("[updateStatus] result", result);
        } else {
          swal("Something went wrong", "Unable to Student Level", "error");
          console.log("[UPDATE ERROR]", err.response);
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
          StudentLevel.delete(slug, (err, removedSlug) => {
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
      const levelName = e.target.name.value;
      const slug = e.target.slug.value;
      const status = e.target.status.value;
      const payload = { name: levelName, slug: slug, status: status };

      StudentLevel.update(payload, (err, update) => {
        if (!err) {
          this.studentLevels.data[this.levelIndex] = update;
          this.editingMode = false;
          console.log("[update] result", update);
          swal("Success!", "Successfully updated level", "success");
        } else {
          swal("Something went wrong", "Unable to update level", "err");
          console.log("[update] error", err.response);
        }
      });
    },
    editStudentLevel(slug) {
      console.log("EDIT SUBJECT", slug);
      /**
       * get the index of current subject to be edit
       * it will be used to update the frontend data once update is successful
       */
      this.levelIndex = this.studentLevels.data.findIndex(
        level => level.slug === slug
      );

      /**
       * store selected object for edit, modal is binding to this data
       * and responsible for displaying it
       */
      this.selectedLevel = this.studentLevels.data[this.levelIndex];

      // set editing mode to true to bring up the modal
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
