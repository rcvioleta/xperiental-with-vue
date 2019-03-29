<template>
  <div class="card" id="subject-add">
    <div class="card-header">
      <h4>
        <strong>Add Subject</strong>
      </h4>
    </div>
    <div class="card-body">
      <form @submit.prevent="saveSubject">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">Subject Name</label>
            <input
              type="text"
              name="subject_name"
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
              Save Subject
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
// axios was already imported by subject-crud component, import not required
import { EventBus } from "../../app.js";

import Subject from "../../helpers/Subject.js";

export default {
  data() {
    return {};
  },
  methods: {
    saveSubject(e) {
      const target = e.target;
      const subject = target.subject_name.value;
      const status = target.status.value;
      const newSubject = new Subject(subject, status);
      newSubject.save((err, result) => {
        if (!err) {
          console.log("[ADD SUBJECT RESULT]", result);
          EventBus.$emit("newSubjectAdded", result);
        } else {
          console.log("[SAVE SUBJECT ERROR]", err.message);
          swal("Something went wrong", "Cannot save subject", "error");
        }
      });
    }
  }
};
</script>

<style>
</style>
