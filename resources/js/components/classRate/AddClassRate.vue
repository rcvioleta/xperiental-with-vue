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

import Model from "../../helpers/Model.js";

export default {
  data() {
    return {};
  },
  methods: {
    saveClassRate(e) {
      alert("Yoh");
    }
  }
};
</script>

<style>
</style>
