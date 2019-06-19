<template>
  <div class="card" id="level-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong v-if="editingMode">Edit Level</strong>
        <strong v-else>Add Grade Level</strong>
      </h4>
    </div>
    <div class="card-body">
      <form>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="level-name">Level Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              :class="{'is-invalid': errors.name}"
              id="level-name"
              placeholder="Grade Name"
              v-model="newStudentLevel.name"
              required
            >
            <div class="text-danger">{{errors.name}}</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="level-status">Status</label>
            <div class="form-group">
              <select
                id="level-status"
                class="form-control"
                :class="{'is-invalid': errors.status}"
                name="status"
                v-model="newStudentLevel.status"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="text-danger">{{errors.status}}</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button
              class="btn btn-primary pull-right"
              @click.prevent="updateStudentLevel"
              v-if="editingMode"
            >
              Update Grade Level
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
            <button class="btn btn-primary pull-right" @click.prevent="saveStudentLevel" v-else>
              Save Grade Level
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import Model from "../../helpers/Model.js";

export default {
  data() {
    return {
      newStudentLevel: {
        name: "",
        status: 1
      },
      editingMode: false,
      errors: {}
    };
  },
  created() {
    EventBus.$on("editingStudentLevel", payloads => {
      this.reset();
      this.editingMode = payloads.editing;
      this.newStudentLevel = payloads.data;
    });
  },
  methods: {
    saveStudentLevel(e) {
      const { name, status } = this.newStudentLevel;
      const newStudentLevel = new Model(name, status);
      newStudentLevel.save("student-level", (err, result) => {
        if (!err) {
          console.log("[ADD STUDENT LEVEL RESULT]", result);
          EventBus.$emit("newLevelAdded", result);
          this.reset();
        } else {
          console.log("[SAVE STUDENT LEVEL ERROR]", err.message);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    updateStudentLevel() {
      const { name, slug, status } = this.newStudentLevel;
      const uri = `student-level/${slug}`;
      const payloads = { name, slug: name, status };

      Model.update(uri, payloads, (err, update) => {
        if (!err) {
          console.log("[update] result", update);
          swal("Success!", "Successfull updated student level", "success");
          this.editingMode = false;
          this.reset();
          EventBus.$emit("editingStudentLevelOk");
        } else {
          console.log("[update] error", err.response);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    reset() {
      this.errors = {};
      this.newStudentLevel = Object.keys(this.newStudentLevel).reduce(
        (object, key) => {
          if (key === "status") object[key] = 1;
          else object[key] = "";
          return object;
        },
        {}
      );
    },
    storeErrors(errList) {
      this.errors = Object.keys(errList).reduce((object, key) => {
        object[key] = errList[key][0];
        return object;
      }, {});
    }
  }
};
</script>

<style>
</style>
