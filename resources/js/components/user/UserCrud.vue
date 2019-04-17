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
              >
                <option :value="user.status ? 1 : 0">{{ user.status ? 'Active' : 'Inactive' }}</option>
                <option :value="user.status ? 0 : 1">{{ user.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button type="button" class="btn btn-danger">Remove</button>
              <button type="button" class="btn btn-warning">Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import User from "../../helpers/User.js";

export default {
  data() {
    return {
      users: ""
    };
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
  }
};
</script>

<style>
</style>
