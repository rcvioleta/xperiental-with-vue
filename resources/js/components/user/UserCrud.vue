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
    <user-modal
      :active="isActive"
      :name="selectedUser.name"
      :email="selectedUser.email"
      :status="selectedUser.status"
      :slug="selectedUser.slug"
      :updateFunc="update"
    ></user-modal>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import User from "../../helpers/User.js";
import Modal from "../ui/modal/Modal.vue";

export default {
  data() {
    return {
      users: "",
      selectedUser: "",
      userIndex: "",
      editingMode: false,
      errors: ""
    };
  },
  components: {
    "user-modal": Modal
  },
  created() {
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

    EventBus.$on("newUserAdded", newUser => {
      this.users.data.push(newUser);
      swal("Congrats!", "New user added", "success");
    });

    EventBus.$on("closeModalEvent", () => {
      this.editingMode = false;
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
          User.delete("user/", slug, (err, removedSlug) => {
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
    editUser(slug) {
      console.log("EDIT USER", slug);
      this.userIndex = this.users.data.findIndex(user => user.slug === slug);

      this.selectedUser = this.users.data[this.userIndex];
      this.editingMode = true;
    },
    update(e) {
      const target = e.target;
      const name = target.name.value;
      const slug = target.slug.value;
      const status = target.status.value;
      const email = target.email.value;
      const password = target.password.value;
      const password_confirmation = target.password_confirmation.value;
      const payload = {
        name,
        slug,
        status,
        email,
        password,
        password_confirmation
      };

      User.update("user/", payload, (err, update) => {
        if (!err) {
          this.users.data[this.userIndex] = update;
          this.editingMode = false;
          this.userIndex = "";
          this.selectedUser = "";
          console.log("[update] result", update);
          swal("Success!", "Successfully updated user information", "success");
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
  },
  computed: {
    isActive() {
      return {
        "in-use": this.editingMode
      };
    }
  }
};
</script>

<style>
</style>
