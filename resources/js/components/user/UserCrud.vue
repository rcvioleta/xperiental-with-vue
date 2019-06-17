<template>
  <div id="user">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="user in users.data" :key="user.slug">
          <td>{{ user.name }}</td>
          <td>{{ user.email }}</td>
          <td>
            <div class="btn-group">
              <select
                class="btn btn-primary btn-sm dropdown-toggle"
                name="status"
                v-model="user.status"
                @change="updateUserStatus($event, user.slug)"
              >
                <option :value="user.status ? 1 : 0">{{ user.status ? 'Active' : 'Inactive' }}</option>
                <option :value="user.status ? 0 : 1">{{ user.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button type="button" class="btn btn-danger" @click="deleteUser(user.slug)">Remove</button>
              <button type="button" class="btn btn-warning" @click="editUser(user.slug)">Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import User from "../../helpers/User.js";

export default {
  data() {
    return {
      users: "",
      index: "",
      errors: ""
    };
  },
  created() {
    this.fetchUsers();

    EventBus.$on("editingUserOk", () => {
      this.fetchUsers();
    });

    EventBus.$on("newUserAdded", newUser => {
      this.users.data.push(newUser);
      swal("Congrats!", "New user added", "success");
    });
  },
  methods: {
    updateUserStatus(e, slug) {
      const status = Number(e.target.value);
      let uri = "";

      if (status === 1) uri = `user/active/${slug}`;
      else uri = `user/inactive/${slug}`;

      User.updateStatus(uri, (err, result) => {
        if (!err) {
          console.log("update status", result);
          swal("Congrats!", result, "success");
        } else {
          console.log("error updating status", err.response.data);
          swal(
            "Sorry... Something went wrong :(",
            "Unable to update user status",
            "error"
          );
        }
      });
    },
    deleteUser(slug) {
      swal({
        title: "Continue removing user?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          User.delete(`user/${slug}`, (err, removedSlug) => {
            if (!err) {
              this.users.data = this.users.data.filter(
                user => user.slug !== removedSlug
              );
              swal("User was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedSlug);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete User. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("User was kept");
      });
    },
    editUser(selectedSlug) {
      console.log("EDIT USER", selectedSlug);
      this.index = this.users.data.findIndex(
        user => user.slug === selectedSlug
      );

      const data = { ...this.users.data[this.index] };
      const payloads = { editing: true, data };
      EventBus.$emit("editingUser", payloads);
    },
    fetchUsers() {
      User.fetchAll("user", (err, data) => {
        if (!err) {
          this.users = data;
          console.log("[FETCHED USERS]", data);
        } else {
          swal(
            "Something went wrong",
            "Unable to get users from database",
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
