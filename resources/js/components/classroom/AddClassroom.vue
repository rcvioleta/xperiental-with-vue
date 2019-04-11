<template>
  <div class="card" id="classroom-add">
    <div class="card-header">
      <h4>
        <strong>Add Classroom</strong>
      </h4>
    </div>
    <div class="card-body">
      <form @submit.prevent="saveClassroom">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">Classroom Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              id="validationCustom01"
              placeholder="Subject"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationCustom02">Status</label>
            <div class="form-group">
              <select class="form-control" name="status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary pull-right" type="submit">
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
    return {};
  },
  methods: {
    saveClassroom(e) {
      const target = e.target;
      const name = target.name.value;
      const status = target.status.value;
      const newClassroom = new Model(name, status);
      newClassroom.save("classroom", (err, result) => {
        if (!err) {
          console.log("[ADD CLASSROOM RESULT]", result);
          EventBus.$emit("newClassroomAdded", result);
        } else {
          console.log("[SAVE CLASSROOM ERROR]", err.message);
          swal("Something went wrong", "Cannot save classroom", "error");
        }
      });
    }
  }
};
</script>

<style>
</style>
