<template>
  <div class="card" id="classroom-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong v-if="editingMode">Edit Classroom</strong>
        <strong v-else>Add Classroom</strong>
      </h4>
    </div>
    <div class="card-body">
      <form @submit.prevent="saveClassroom">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="classroom-name">Classroom Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              :class="{'is-invalid': errors.name}"
              id="classroom-name"
              placeholder="Subject"
              v-model="newClassroom.name"
              required
            >
            <div class="text-danger">{{errors.name}}</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="classroom-status">Status</label>
            <div class="form-group">
              <select
                id="classroom-status"
                class="form-control"
                name="status"
                :class="{'is-invalid': errors.status}"
                v-model="newClassroom.status"
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
              @click.prevent="updateClassroom"
              v-if="editingMode"
            >
              Update Classroom
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
            <button class="btn btn-primary pull-right" @click.prevent="saveClassroom" v-else>
              Save Classroom
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
      newClassroom: {
        name: "",
        status: 1
      },
      editingMode: false,
      errors: {}
    };
  },
  created() {
    EventBus.$on("editingClassroom", payloads => {
      this.reset();
      this.editingMode = payloads.editing;
      this.newClassroom = payloads.data;
    });
  },
  methods: {
    saveClassroom() {
      const { name, status } = this.newClassroom;
      const newClassroom = new Model(name, status);
      newClassroom.save("classroom", (err, result) => {
        if (!err) {
          console.log("[ADD CLASSROOM RESULT]", result);
          EventBus.$emit("newClassroomAdded", result);
          this.reset();
        } else {
          console.log("[SAVE CLASSROOM ERROR]", err.response.data);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    updateClassroom() {
      const { name, slug, status } = this.newClassroom;
      const uri = `classroom/${slug}`;
      const payloads = { name, slug: name, status };

      Model.update(uri, payloads, (err, update) => {
        if (!err) {
          console.log("[update] result", update);
          swal("Success!", "Successfully updated Classroom", "success");
          this.editingMode = false;
          this.reset();
          EventBus.$emit("editingClassroomOk");
        } else {
          console.log("[update] error", err.response);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    reset() {
      this.errors = {};
      this.newClassroom = Object.keys(this.newClassroom).reduce(
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
