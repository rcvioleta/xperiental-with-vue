<template>
  <div id="add-class-schedule">
    <div class="container-fluid">
      <table id="datatable-1" class="table table-datatable table-striped table-hover">
        <thead>
          <tr>
            <th>Class Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Students</th>
            <th>Class Rates</th>
            <th>Subjects</th>
            <th>Classroom</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="subject in subjects.data" :key="subject.slug">
            <td>{{ subject.name }}</td>
            <td>
              <div class="btn-group">
                <select
                  class="btn btn-primary btn-sm dropdown-toggle"
                  name="status"
                  v-model="subject.status"
                  @change="updateStatus($event, subject.slug)"
                >
                  <option
                    :value="subject.status ? 1 : 0"
                  >{{ subject.status ? 'Active' : 'Inactive' }}</option>
                  <option
                    :value="subject.status ? 0 : 1"
                  >{{ subject.status ? 'Inactive' : 'Active' }}</option>
                </select>
              </div>
            </td>
            <td>
              <!-- <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                <button
                  type="button"
                  class="btn btn-danger"
                  @click="deleteSubject(subject.slug)"
                >Remove</button>
                <button
                  type="button"
                  class="btn btn-warning"
                  @click="editSubject(subject.slug)"
                >Edit</button>
              </div>-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="modal-footer mr-3">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" @click="editClassSchedule">
        Edit Schedule
        <i class="ml-2 batch-icon batch-icon-stiffy"></i>
      </button>
    </div>
  </div>
</template>

<script>
import Model from "../../helpers/Model.js";

const fetchAll = Model.fetchAll.bind(null);

export default {
  data() {
    return {
      class_rates: "",
      classrooms: "",
      students: "",
      subjects: "",
      schedules: ""
    };
  },
  created() {
    this.fetchAll();
  },
  beforeUpdate() {
    console.log("edit class schedule beforeUpdate hook");
  },
  methods: {
    editClassSchedule() {
      EventBus.$on("fetchedScheduleData", payloads => {
        console.log("PAYLOADS", payloads);
      });
    },
    getAllSchedules() {
      fetchAll("schedules", (err, data) => {
        if (!err) this.schedules = data;
        else console.log("Cannot get schedules", err.response.data);
      });
    },
    getAllStudents() {
      fetchAll("student", (err, data) => {
        if (!err) this.students = data;
        else console.log("Cannot get schedules", err.response.data);
      });
    },
    getAllSubjects() {
      fetchAll("subject", (err, data) => {
        if (!err) this.subjects = data;
        else console.log("Cannot get schedules", err.response.data);
      });
    },
    getAllClassrooms() {
      fetchAll("classroom", (err, data) => {
        if (!err) this.classrooms = data;
        else console.log("Cannot get schedules", err.response.data);
      });
    },
    getAllClassRates() {
      fetchAll("class-rate", (err, data) => {
        if (!err) this.class_rates = data;
        else console.log("Cannot get class rates", err.response.data);
      });
    },
    fetchAll() {
      this.getAllClassRates();
      this.getAllSchedules();
      this.getAllStudents();
      this.getAllSubjects();
      this.getAllClassrooms();
    }
  }
};
</script>

<style>
</style>
