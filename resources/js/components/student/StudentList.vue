<template>
  <div id="student-list">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Full Name</th>
          <th>Gender</th>
          <th>Birthdate</th>
          <th>Telephone/Phone</th>
          <th>Address</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <template v-if="students">
          <tr v-for="student in students.data" :key="student.id">
            <td>{{ student.last_name }}, {{ student.first_name }} {{ student.middle_name }}</td>
            <td>{{ student.gender }}</td>
            <td>{{ student.birth_date }}</td>
            <td>{{ student.phone_number }}</td>
            <td>{{ student.address }}</td>
            <td>
              <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <button type="button" class="btn btn-danger">Remove</button>
                <button type="button" class="btn btn-warning">Edit</button>
              </div>
            </td>
          </tr>
        </template>
        <template v-else-if="!students && didFetching">
          <tr>
            <td colspan="6" class="text-center">
              <h3>No Student Record in the database</h3>
            </td>
          </tr>
        </template>
        <template v-else>
          <tr>
            <td colspan="6" class="text-center">
              <img src="../../assets/images/loading.gif" alt="Loading Students">
              <h3>Loading Students...</h3>
            </td>
          </tr>
        </template>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      students: "",
      didFetching: false
    };
  },
  created() {
    axios
      .get("student")
      .then(response => {
        this.students = response.data;
        this.didFetching = true;
      })
      .catch(err => console.log(err));
  }
};
</script>

<style>
</style>
