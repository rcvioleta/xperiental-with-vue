<template>
  <div id="modal">
    <div class="backdrop" :class="active"></div>
    <div class="main-modal" :class="active">
      <div class="card">
        <div class="card-header">
          Edit: {{ name }}
          <span
            @click="closeModal"
            style="float: right; color: red; font-weight: bold; cursor: pointer;"
          >X</span>
        </div>
        <div class="card-body">
          <form @submit.prevent="updateFunc" @input="inputChanges">
            <input type="hidden" name="slug" :value="slug">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" class="form-control" :value="name">
            </div>

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" class="form-control" :value="email">
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                :value="password"
              >
            </div>

            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                :value="password_confirmation"
              >
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option :value="status ? 1 : 0">{{ status ? 'Active' : 'Inactive' }}</option>
                <option :value="status ? 0 : 1">{{ status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";

export default {
  props: [
    "slug",
    "name",
    "status",
    "updateFunc",
    "active",
    "email",
    "password",
    "password_confirmation"
  ],
  data() {
    return {};
  },
  methods: {
    closeModal() {
      EventBus.$emit("closeModalEvent");
    },
    inputChanges(e) {
      switch (e.srcElement.name) {
        case "name":
          this.$emit("userNameChanged", e.target.value);
          break;
        case "email":
          this.$emit("emailChanged", e.target.value);
          break;
        case "status":
          this.$emit("statusChanged", e.target.value);
          break;
        case "password":
          this.$emit("passwordChanged", e.target.value);
          break;
        case "password_confirmation":
          this.$emit("passConfirmationChanged", e.target.value);
          break;
      }
    }
  }
};
</script>

<style scoped>
.main-modal {
  position: fixed;
  top: 50%;
  left: 50%;
  width: 80%;
  transform: translate(-50%, -50%);
  z-index: 200;
  display: none;
}

.backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 100;
  background: rgba(0, 0, 0, 0.7);
  display: none;
}

.main-modal.in-use,
.backdrop.in-use {
  display: block;
}

@media (min-width: 48em) {
  .main-modal {
    width: 30%;
  }
}
</style>
