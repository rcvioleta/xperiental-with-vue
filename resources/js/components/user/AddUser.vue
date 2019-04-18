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
              id="profile-name"
              placeholder="Name"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="email">Email</label>
            <input
              type="email"
              name="email"
              class="form-control"
              id="email"
              placeholder="Email"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="password">Password</label>
            <input
              type="text"
              name="password"
              class="form-control"
              id="password"
              placeholder="Password"
              required
            >
            <div class="valid-feedback">Looks good!</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input
              type="text"
              name="password_confirmation"
              class="form-control"
              id="password_confirmation"
              placeholder="Confirm Password"
              required
            >
            <div class="valid-feedback">Looks good!</div>
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
      errors: ""
    };
  },
  methods: {
    saveNewUser(e) {
      const target = e.target;
      const name = target.name.value;
      const email = target.email.value;
      const password = target.password.value;
      const password_confirmation = target.password_confirmation.value;
      const newUser = new User(name, 1, email, password, password_confirmation);
      newUser.save("user", (err, result) => {
        if (!err) {
          console.log("[SAVE USER RESULT]", result);
          EventBus.$emit("newUserAdded", result);
        } else {
          console.log("[SAVE USER ERROR]", err.response.data);
          this.errors = Object.keys(err.response.data.errors).map(key => {
            return [...Array(err.response.data.errors[key])].map(errorArr => {
              return Object.keys(errorArr).map(error => errorArr[error]);
            });
          });
          swal(
            "Something went wrong",
            this.errors
              .toString()
              .split(",")
              .join("\n"),
            "error"
          );
        }
      });
    }
  }
};
</script>

<style>
</style>
