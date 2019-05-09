<template>
  <div id="add-class-schedule">
    <div class="container-fluid">
      <form>
        <div class="form-row pt-3">
          <div class="col-md-3">
            <label for="validationCustom02">Class Date</label>
            <input
              type="date"
              name="class_date"
              class="fallback form-control"
              autocomplete="off"
              v-model="form_data.class_date"
              required
            >
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom02">Start Time</label>
            <div class="input-group">
              <select
                class="custom-select"
                name="start_time_hour"
                id="inputGroupSelect01"
                v-model="form_data.start_time_hour"
              >
                <option disabled value>HH</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              <select
                class="custom-select"
                name="start_time_minute"
                id="inputGroupSelect01"
                v-model="form_data.start_time_minute"
              >
                <option disabled value>Min</option>
                <option value="00">00</option>
                <option value="30">30</option>
              </select>
              <select
                class="custom-select"
                name="start_time_period"
                id="inputGroupSelect01"
                v-model="form_data.start_time_period"
              >
                <option disabled value>AM/PM</option>
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom02">End Time</label>
            <div class="input-group mb-3">
              <select
                class="custom-select"
                name="end_time_hour"
                id="inputGroupSelect01"
                v-model="form_data.end_time_hour"
              >
                <option disabled value>HH</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>
              <select
                class="custom-select"
                name="end_time_minute"
                id="inputGroupSelect01"
                v-model="form_data.end_time_minute"
              >
                <option disabled value>Min</option>
                <option value="00">00</option>
                <option value="30">30</option>
              </select>
              <select
                class="custom-select"
                name="end_time_period"
                id="inputGroupSelect01"
                v-model="form_data.end_time_period"
              >
                <option disabled value>AM/PM</option>
                <option value="AM">AM</option>
                <option value="PM">PM</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom02">Class Type</label>
            <div class="form-group">
              <select class="form-control" name="class_rate" v-model="form_data.class_rate">
                <option disabled value>-- Select Class Rate --</option>
                <option
                  v-for="classRate in class_rates.data"
                  :key="classRate.slug"
                  :value="classRate.id"
                >{{ classRate.name }}</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row pt-3">
          <div class="col-md-3">
            <label for="validationCustom02">Subject</label>
            <div class="form-group">
              <select class="form-control" name="subject" v-model="form_data.subject">
                <option disabled value>-- Select Subject --</option>
                <option
                  v-for="subject in subjects.data"
                  :key="subject.slug"
                  :value="subject.id"
                >{{ subject.name }}</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom02">Classroom</label>
            <div class="form-group">
              <select class="form-control" name="classroom" v-model="form_data.classroom">
                <option disabled value>-- Select Classrooom --</option>
                <option
                  v-for="classroom in classrooms.data"
                  :key="classroom.slug"
                  :value="classroom.id"
                >{{ classroom.name }}</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <label for="validationCustom02">Status</label>
            <div class="form-group">
              <select class="form-control" name="status" v-model="form_data.status">
                <option disabled value>-- Select Status --</option>
                <option value="1">Active</option>
                <option value="0">Cancelled</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-row mt-5">
          <div class="col-md-12">
            <h2>Select Student</h2>
            <select name="student" class="form-control" @change="selectStudent">
              <option disabled value>-- Select Student --</option>
              <option
                v-for="student in students.data"
                :value="student.id"
                :key="student.slug"
              >{{ `${student.first_name} ${student.middle_name} ${student.last_name}` }}</option>
            </select>
            <strong>
              Selected:
              <span
                v-for="selectedStd in selectedStudents"
                :key="selectedStd.id"
              >{{ `${selectedStd.first_name} ${selectedStd.last_name}, ` }}</span>
            </strong>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer mr-3">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      <button type="button" class="btn btn-primary" @click="saveClassSchedule">
        Save Schedule
        <i class="ml-2 batch-icon batch-icon-stiffy"></i>
      </button>
    </div>
  </div>
</template>

<script>
import axios from "axios";

import Model from "../../helpers/Model.js";

const fetchAll = Model.fetchAll.bind(null);

export default {
  data() {
    return {
      class_rates: "",
      classrooms: "",
      students: "",
      subjects: "",
      form_data: {
        class_date: "",
        start_time_hour: "",
        start_time_minute: "",
        start_time_period: "",
        end_time_hour: "",
        end_time_minute: "",
        end_time_period: "",
        class_rate: "",
        subject: "",
        students: [],
        classroom: "",
        status: ""
      },
      selectedStudents: []
    };
  },
  created() {
    this.fetchAllFormData();
  },
  methods: {
    saveClassSchedule() {
      axios
        .post("class-schedule")
        .then(response => console.log("got response from server", response))
        .catch(err => console.log("an errors has been found", err.response));
    },
    getAllStudents() {
      fetchAll("student", (err, data) => {
        if (!err) this.students = data;
        else
          console.log("Error while fetching Students database", err.response);
      });
    },
    getAllSubjects() {
      fetchAll("subject", (err, data) => {
        if (!err) this.subjects = data;
        else
          console.log("Error while fetching Subjects database", err.response);
      });
    },
    getAllClassRates() {
      fetchAll("class-rate", (err, data) => {
        if (!err) this.class_rates = data;
        else
          console.log(
            "Error while fetching Class Rates database",
            err.response
          );
      });
    },
    getAllClassrooms() {
      fetchAll("classroom", (err, data) => {
        if (!err) this.classrooms = data;
        else
          console.log("Error while fetching Classrooms database", err.response);
      });
    },
    selectStudent(event) {
      console.log("student id", event.target.value);
      this.form_data.students.push(event.target.value);
      const newStd = this.students.data.find(student => {
        return student.id === +event.target.value;
      });
      console.log("new student", newStd);
      this.selectedStudents.push(newStd);
    },
    fetchAllFormData() {
      this.getAllClassRates();
      this.getAllClassrooms();
      this.getAllStudents();
      this.getAllSubjects();
    }
  }
};
</script>

<style>
</style>
