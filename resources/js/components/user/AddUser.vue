<template>
  <div class="card" id="system-add" style="display: none;">
    <div class="card-header">
      <h4>
        <strong v-if="editingMode">Update System User</strong>
        <strong v-else>Add System User</strong>
      </h4>
    </div>
    <div class="card-body">
      <form>
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
              v-model="newUser.name"
            >
            <div class="text-danger">{{ errors.name }}</div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="avatar">Profile Picture</label>
            <input type="file" name="avatar" class="form-control" @change="onImageChange">
            <img
              class="img-fluid rounded"
              :src="newUser.avatar"
              alt="Profile Picture"
              accept="image/*"
              width="150px"
              v-show="newUser.avatar"
            >
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
              v-model="newUser.email"
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
              v-model="newUser.password"
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
              v-model="newUser.password_confirmation"
            >
            <div class="text-danger">{{ errors.password_confirmation }}</div>
          </div>
          <div class="col-md-12 mb-3">
            <div class="form-group">
              <label for="status">Status</label>
              <select
                class="form-control"
                :class="{'is-invalid': errors.status}"
                name="status"
                v-model="newUser.status"
              >
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <button
              class="btn btn-primary pull-right"
              @click.prevent="updateUser"
              v-if="editingMode"
            >
              Update User
              <i class="ml-2 batch-icon batch-icon-stiffy"></i>
            </button>
            <button class="btn btn-primary pull-right" @click.prevent="saveNewUser" v-else>
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
      newUser: {
        name: "",
        avatar: "",
        email: "",
        password: "",
        password_confirmation: "",
        status: 1
      },
      editingMode: false,
      errors: {}
    };
  },
  created() {
    EventBus.$on("editingUser", payloads => {
      this.reset();
      this.editingMode = payloads.editing;
      this.newUser = payloads.data;
    });
  },
  methods: {
    saveNewUser() {
      const {
        name,
        email,
        password,
        password_confirmation,
        status
      } = this.newUser;
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
          this.reset();
          EventBus.$emit("newUserAdded", result);
        } else {
          console.log("[SAVE USER ERROR]", err.response.data);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    updateUser() {
      const {
        name,
        slug,
        status,
        email,
        password,
        password_confirmation
      } = this.newUser;
      const uri = `user/${slug}`;
      const payloads = {
        name,
        status,
        email,
        password,
        password_confirmation
      };

      User.update(uri, payloads, (err, update) => {
        if (!err) {
          swal("Success!", "Successfully updated user information", "success");
          console.log("[update] result", update);
          this.editingMode = false;
          this.reset();
          EventBus.$emit("editingUserOk");
        } else {
          console.log("[SAVE USER ERROR]", err.response.data);
          const errList = err.response.data.errors;
          this.storeErrors(errList);
        }
      });
    },
    onImageChange(event) {
      const input = event.target;

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
          this.newUser.avatar = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    reset() {
      this.errors = {};
      this.newUser = Object.keys(this.newUser).reduce((object, key) => {
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
