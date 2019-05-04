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
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="deleteStudent(student.id)"
                >Remove</button>
                <button type="button" class="btn btn-warning" @click="editStudent(student.id)">Edit</button>
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

    <student-form
      :active="isActive"
      :closeForm="closeForm"
      :method="updateStudent"
      :formData="selectedStudent"
      @fnameChanged="selectedStudent.first_name = $event"
      @mnameChanged="selectedStudent.middle_name = $event"
      @lnameChanged="selectedStudent.last_name = $event"
      @genderChanged="selectedStudent.gender = $event"
      @bdayChanged="selectedStudent.birth_date = $event"
      @pnumberChanged="selectedStudent.phone_number = $event"
      @addressChanged="selectedStudent.address = $event"
    />
  </div>
</template>

<script>
import Model from "../../helpers/Model.js";
import StudentForm from "../forms/StudentForm.vue";

const fetchStudents = Model.fetchAll.bind(null);
const delStudent = Model.delete.bind(null);

export default {
  data() {
    return {
      students: "",
      selectedStudent: "",
      studentIndex: "",
      didFetching: false,
      editingMode: false
    };
  },
  components: {
    "student-form": StudentForm
  },
  beforeUpdate() {
    console.log("trying to update");
  },
  created() {
    fetchStudents("student", (err, data) => {
      if (!err) {
        this.students = data;
        this.didFetching = true;
        console.log("Fetch success!", data);
      } else {
        console.log("Error found while fetching...", err);
      }
    });
  },
  methods: {
    deleteStudent(id) {
      swal({
        title: "Continue removing this student?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          delStudent(`student/${id}`, (err, removedId) => {
            if (!err) {
              this.students.data = this.students.data.filter(
                student => student.id !== id
              );
              swal("Student was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedId);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete Student. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("Student information was kept");
      });
    },
    editStudent(id) {
      this.editingMode = true;
      this.studentIndex = this.students.data.findIndex(
        student => student.id === id
      );
      const studentObj = this.students.data[this.studentIndex];
      this.selectedStudent = { ...studentObj };
    },
    updateStudent() {
      console.log("Update Student Information", this.selectedStudent);
    },
    closeForm() {
      this.editingMode = false;
      this.resetForm();
    },
    resetForm() {
      Object.keys(this.selectedStudent).map(key => {
        this.selectedStudent[key] = "";
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
