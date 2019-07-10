<template>
  <div class="card" id="class-rate-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong v-if="!editingMode">Add Class Type</strong>
        <strong v-else>Edit Class Type</strong>
      </h4>
    </div>
    <div class="card-body">
      <form>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="class-rate-name">Class Type Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              :class="{'is-invalid': errors.name }"
              id="class-rate-name"
              v-model="newClassRate.name"
              required
            >
            <div class="text-danger">{{errors.name}}</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="rate">Rate</label>
            <input
              type="text"
              name="rate"
              class="form-control"
              :class="{'is-invalid': errors.rate }"
              id="rate"
              v-model="newClassRate.rate"
              required
            >
            <div class="text-danger">{{ errors.rate }}</div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="class-rate-status">Status</label>
            <div class="form-group">
              <select
                id="class-rate-status"
                class="form-control"
                :class="{'is-invalid': errors.status }"
                name="status"
                v-model="newClassRate.status"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
            <div class="text-danger">{{ errors.status }}</div>
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
      editingMode: false,
      errors: {}
    };
  },
  created() {
    EventBus.$on("editingClassRate", payloads => {
      this.reset();
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
          this.errors = {};
          EventBus.$emit("newClassRateAdded", result);
          this.reset();
        } else {
          console.log("[SAVE CLASS RATE ERROR]", err.response.data);
          // swal("Something went wrong", "Cannot add new class type", "error");
          const errList = err.response.data.errors;
          this.storeErrors(errList);
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
          this.editingMode = false;
          this.errors = {};
          console.log("[update] result", update);
          swal("Success!", "Successfully updated Class Type", "success");
          this.editingMode = false;
          this.reset();
          // let ClassRateCrud component know that it requires to fetch updates
          EventBus.$emit("editingClassRateOk");
        } else {
          console.log("[update] error", err.response);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    reset() {
      this.errors = {};
      this.newClassRate = Object.keys(this.newClassRate).reduce(
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
