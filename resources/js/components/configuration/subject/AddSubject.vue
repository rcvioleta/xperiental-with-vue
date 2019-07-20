<template>
  <div class="card" id="subject-add" style="display: block;">
    <div class="card-header">
      <h4>
        <strong v-if="editingMode">Edit Subject</strong>
        <strong v-else>Add Subject</strong>
      </h4>
    </div>
    <div class="card-body">
      <form>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="subject-name">Subject Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              :class="{'is-invalid': errors.name}"
              id="subject-name"
              placeholder="Subject"
              v-model="newSubject.name"
              required
            >
            <div class="text-danger">{{ errors.name }}</div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="status">Status</label>
            <div class="form-group">
              <select
                id="status"
                class="form-control"
                :class="{'is-invalid': errors.status}"
                name="status"
                v-model="newSubject.status"
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
              @click.prevent="updateSubject(newSubject.id)"
              v-if="editingMode"
            >
              Update Subject
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
            <button class="btn btn-primary pull-right" @click.prevent="saveSubject" v-else>
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
import { EventBus } from "../../../app.js";
import Model from "../../../helpers/Model.js";

export default {
  data() {
    return {
      newSubject: {
        id: "",
        name: "",
        status: 1
      },
      editingMode: false,
      errors: {}
    };
  },
  created() {
    EventBus.$on("editingSubject", payloads => {
      this.reset();
      this.editingMode = payloads.editing;
      this.newSubject = payloads.data;
    });
  },
  methods: {
    saveSubject() {
      const { name, status } = this.newSubject;
      const newSubject = new Model(name, status);
      newSubject.save("subject", (err, result) => {
        if (!err) {
          console.log("[ADD SUBJECT RESULT]", result);
          EventBus.$emit("newSubjectAdded", result);
          this.reset();
        } else {
          console.log("[SAVE SUBJECT ERROR]", err.response.data.errors);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    updateSubject(id) {
      const { name, slug, status } = this.newSubject;
      const uri = `subject/${id}`;
      const payloads = { name, slug: name, status };

      Model.update(uri, payloads, (err, update) => {
        if (!err) {
          console.log("[updateStatus] result", update);
          swal("Success!", "Successfull updated subject", "success");
          this.editingMode = false;
          this.reset();
          EventBus.$emit("editingSubjectOk");
        } else {
          console.log("[updateStatus] error", err.response.data.errors);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    reset() {
      this.errors = {};
      this.newSubject = Object.keys(this.newSubject).reduce((object, key) => {
        if (key === "status") object[key] = 1;
        else object[key] = "";
        return object;
      }, {});
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
