<template>
  <div class="card" id="system-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong>Add System User</strong>
      </h4>
    </div>
    <div class="card-body">
      <form class="needs-validation" @submit.prevent="saveNewUser">
        <div class="form-row">
          <div class="col-md-12 mb-3">
            <label for="profile-name">Profile Name</label>
            <input
              type="text"
              name="name"
              class="form-control"
              :class="{'is-invalid': errors.name}"
              id="profile-name"
              placeholder="Name"
              v-model="form_data.name"
            >
            <div class="text-danger">{{ errors.name }}</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="email">Email</label>
            <input
              type="email"
              name="email"
              class="form-control"
              :class="{'is-invalid': errors.email}"
              id="email"
              placeholder="Email"
              v-model="form_data.email"
            >
            <div class="text-danger">{{ errors.email }}</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="password">Password</label>
            <input
              type="password"
              name="password"
              class="form-control"
              :class="{'is-invalid': errors.password}"
              id="password"
              placeholder="Password"
              v-model="form_data.password"
            >
            <div class="text-danger">{{ errors.password }}</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input
              type="password"
              name="password_confirmation"
              class="form-control"
              :class="{'is-invalid': errors.password_confirmation}"
              id="password_confirmation"
              placeholder="Confirm Password"
              v-model="form_data.password_confirmation"
            >
            <div class="text-danger">{{ errors.password_confirmation }}</div>
          </div>
          <!-- <div class="col-md-6 mb-3">
            <label for="validationCustom04">Status</label>
            <div class="form-group">
              <select class="form-control" id="validationCustom04">
                <option>Active</option>
                <option>Inactive</option>
              </select>
            </div>
            <div class="valid-feedback">Looks good!</div>
          </div>-->
        </div>
        <div class="row">
          <div class="col-md-12">
            <button class="btn btn-primary pull-right" type="submit">
              Save User
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

import User from "../../helpers/User.js";

export default {
  data() {
    return {
      errors: {},
      form_data: {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        status: 1
      }
    };
  },
  methods: {
    saveNewUser(e) {
      const {
        name,
        email,
        password,
        password_confirmation,
        status
      } = this.form_data;
      const newUser = new User(
        name,
        status,
        email,
        password,
        password_confirmation
      );
      newUser.save("user", (err, result) => {
        if (!err) {
          console.log("[SAVE USER RESULT]", result);
          this.errors = {};
          this.form_data = Object.keys(this.form_data).reduce((object, key) => {
            if (key === "status") object[key] = this.form_data[key];
            else object[key] = "";
            return object;
          }, {});
          EventBus.$emit("newUserAdded", result);
        } else {
          console.log("[SAVE USER ERROR]", err.response.data);
          const errList = err.response.data.errors;
          this.errors = Object.keys(errList).reduce((object, key) => {
            object[key] = errList[key][0];
            return object;
          }, {});
        }
      });
    }
  }
};
</script>

<style>
</style>
