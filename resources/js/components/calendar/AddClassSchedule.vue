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
              <select class="form-control" name="class_rate" v-model="form_data.class_rate_id">
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
              <select class="form-control" name="subject" v-model="form_data.subject_id">
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
              <select class="form-control" name="classroom" v-model="form_data.classroom_id">
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
            <template v-if="students.data">
              <Multiselect
                v-model="form_data.students"
                :options="students.data"
                :multiple="true"
                :close-on-select="false"
                label="full_name"
                track-by="id"
                placeholder="Select Students"
              ></Multiselect>
            </template>
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
import Multiselect from "vue-multiselect";
import swal from "sweetalert";

import Model from "../../helpers/Model.js";
import ClassSchedule from "../../helpers/ClassSchedule.js";

const fetchAll = Model.fetchAll.bind(null);

export default {
  components: {
    Multiselect
  },
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
        class_rate_id: "",
        subject_id: "",
        students: [],
        classroom_id: "",
        status: ""
      }
    };
  },
  created() {
    this.fetchAllFormData();
  },
  methods: {
    saveClassSchedule() {
      const {
        class_date,
        class_rate_id,
        subject_id,
        classroom_id,
        status
      } = this.form_data;
      const start_time = `${this.form_data.start_time_hour}:${
        this.form_data.start_time_minute
      } ${this.form_data.start_time_period}`;
      const end_time = `${this.form_data.end_time_hour}:${
        this.form_data.end_time_minute
      } ${this.form_data.end_time_period}`;
      const students = this.form_data.students
        .map(student => student.id)
        .toString()
        .split(", ")
        .join(", ");
      const payloads = {
        students,
        class_date,
        start_time,
        end_time,
        class_rate_id,
        subject_id,
        classroom_id,
        status
      };
      console.table("Schedules", payloads);
      const newSchedule = new ClassSchedule(
        students,
        class_date,
        start_time,
        end_time,
        class_rate_id,
        subject_id,
        classroom_id,
        status
      );
      newSchedule.saveClassSchedule("schedule", (err, response) => {
        if (!err) {
          console.log("RESPONSE", response);
          swal("Congratulations!", "New Schedule added", "success");
        } else {
          console.log("Error adding new schedule", err.response.data);
          swal(
            "Something went wrong :(",
            "Unable to add new Schedule",
            "error"
          );
        }
      });
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
    fetchAllFormData() {
      this.getAllClassRates();
      this.getAllClassrooms();
      this.getAllStudents();
      this.getAllSubjects();
    }
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>