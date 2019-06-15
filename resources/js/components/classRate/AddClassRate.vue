<template>
  <div class="card" id="class-rate-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong v-if="!editingMode">Add Class Rate</strong>
        <strong v-else>Edit Class Rate</strong>
      </h4>
    </div>
    <div class="card-body">
      <form>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom01">Class Rate Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              id="validationCustom01"
              placeholder="Class Rate Name"
              v-model="newClassRate.name"
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
              v-model="newClassRate.rate"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom02">Status</label>
            <div class="form-group">
              <select class="form-control" name="status" v-model="newClassRate.status">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button
              class="btn btn-primary pull-right"
              @click.prevent="saveClassRate"
              v-if="!editingMode"
            >
              Save Class Rate
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
            <button class="btn btn-primary pull-right" @click.prevent="updateClassRate" v-else>
              Update Class Rate
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
    return {
      newClassRate: {
        name: "",
        rate: "",
        status: 1
      },
      editingMode: false
    };
  },
  created() {
    EventBus.$on("editingMode", payloads => {
      this.editingMode = payloads.editing;
      this.newClassRate = payloads.data;
    });
  },
  methods: {
    saveClassRate() {
      const { name, rate, status } = this.newClassRate;
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
    },
    updateClassRate() {
      const { name, slug, status, rate } = this.newClassRate;
      const uri = `class-rate/${slug}`;
      const payloads = { name, slug: name, status, rate };

      ClassRate.update(uri, payloads, (err, update) => {
        if (!err) {
          // this.classRates.data[this.classRateIndex] = update;
          this.newClassRate = Object.keys(this.newClassRate).reduce(
            (object, key) => {
              if (key === "status") object[key] = 1;
              else object[key] = "";
              return object;
            },
            {}
          );
          this.editingMode = false;
          console.log("[update] result", update);
          swal("Success!", "Successfully updated Class Rate", "success");
        } else {
          swal("Something went wrong", "Unable to update Class Rate", "error");
          console.log("[update] error", err.response);
        }
      });
    }
  }
};
</script>

<style>
</style>
