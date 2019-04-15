<template>
  <div class="card" id="classs-rate-add">
    <div class="card-header">
      <h4>
        <strong>Add Class Rate</strong>
      </h4>
    </div>
    <div class="card-body">
      <form @submit.prevent="saveClassRate">
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">Class Rate Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              id="validationCustom01"
              placeholder="Class Rate Name"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">Rate</label>
            <input
              type="text"
              name="rate"
              class="form-control"
              id="validationCustom03"
              placeholder="Rate"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <div class="form-row">
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
              Save Class Rate
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

import ClassRate from "../../helpers/ClassRate.js";

export default {
  data() {
    return {};
  },
  methods: {
    saveClassRate(e) {
      const target = e.target;
      const name = target.name.value;
      const rate = target.rate.value;
      const status = target.status.value;
      const newClassRate = new ClassRate(name, status, rate);
      newClassRate.save("class-rate", (err, result) => {
        if (!err) {
          console.log("[SAVE CLASS RATE RESULT]", result);
          EventBus.$emit("newClassRateAdded", result);
        } else {
          console.log("[SAVE CLASS RATE ERROR]", err.message);
          swal("Something went wrong", "Cannot add new class rate", "error");
        }
      });
    }
  }
};
</script>

<style>
</style>
