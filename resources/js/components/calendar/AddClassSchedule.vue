<template>
  <div id="add-class-schedule">
    <button
      class="btn btn-primary pull-right"
      type="button"
      data-toggle="modal"
      data-target="#exampleModal"
      @click="clearForm"
    >
      Add New Schedule
      <i class="ml-2 batch-icon batch-icon-plus"></i>
    </button>
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addhistoryModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addhistoryModalLongTitle">ADD NEW SCHEDULE</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                    <div class="small text-danger">{{ errors.class_date }}</div>
                  </div>
                  <div class="col-md-3">
                    <label for="validationCustom02">Start Time</label>
                    <div class="input-group mb-3">
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
                        name="end_time_minute"
                        id="inputGroupSelect01"
                        v-model="form_data.start_time_minute"
                      >
                        <option disabled value>Min</option>
                        <option value="00">00</option>
                        <option value="30">30</option>
                      </select>
                      <select
                        class="custom-select"
                        name="end_time_period"
                        id="inputGroupSelect01"
                        v-model="form_data.start_time_period"
                      >
                        <option disabled value>AM/PM</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                      </select>
                    </div>
                    <div class="small text-danger">{{ errors.start_time }}</div>
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
                    <div class="small text-danger">{{ errors.end_time }}</div>
                  </div>
                  <div class="col-md-3">
                    <label for="validationCustom02">Class Type</label>
                    <div class="form-group">
                      <select
                        class="form-control"
                        name="class_rate"
                        v-model="form_data.class_rate_id"
                      >
                        <option disabled value>-- Select Class Rate --</option>
                        <option
                          v-for="classRate in class_rates.data"
                          :key="classRate.slug"
                          :value="classRate.id"
                        >{{ classRate.name }}</option>
                      </select>
                    </div>
                    <div class="small text-danger">{{ errors.class_rate_id }}</div>
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
                    <div class="small text-danger">{{ errors.subject_id }}</div>
                  </div>
                  <div class="col-md-3">
                    <label for="validationCustom02">Classroom</label>
                    <div class="form-group">
                      <select
                        class="form-control"
                        name="classroom"
                        v-model="form_data.classroom_id"
                      >
                        <option disabled value>-- Select Classrooom --</option>
                        <option
                          v-for="classroom in classrooms.data"
                          :key="classroom.slug"
                          :value="classroom.id"
                        >{{ classroom.name }}</option>
                      </select>
                    </div>
                    <div class="small text-danger">{{ errors.classroom_id }}</div>
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
                    <div class="small text-danger">{{ errors.status }}</div>
                  </div>
                </div>
                <div class="form-row mt-5">
                  <div class="col-md-12">
                    <h2>Select Student</h2>
                    <select class="form-control" id='callbacks' multiple='multiple'>
                        <option v-for="student in students.data" :value="student.id">{{ student.full_name }}</option>
                    </select>
                    <!-- <template v-if="students.data">
                      <Multiselect
                        v-model="form_data.students"
                        :options="students.data"
                        :multiple="true"
                        :close-on-select="false"
                        label="full_name"
                        track-by="id"
                        placeholder="Select Students"
                      ></Multiselect>
                    </template> -->
                  </div>
                  <div class="small text-danger">{{ errors.students }}</div>
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
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Multiselect from "vue-multiselect";
import swal from "sweetalert";

import Model from "../../helpers/Model.js";
import ClassSchedule from "../../helpers/ClassSchedule.js";
import { EventBus } from "../../app";

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
      },
      errors: {}
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
        status,
        start_time_hour,
        start_time_minute,
        start_time_period,
        end_time_hour,
        end_time_minute,
        end_time_period
      } = this.form_data;
      let start_time = "";
      let end_time = "";

      if (start_time_hour && start_time_minute && start_time_period) {
        start_time = `${start_time_hour}:${start_time_minute} ${start_time_period}`;
      }

      if (end_time_hour && end_time_minute && end_time_period) {
        end_time = `${end_time_hour}:${end_time_minute} ${end_time_period}`;
      }

      // const students = this.form_data.students
      //   .map(student => student.id)
      //   .toString()
      //   .split(", ")
      //   .join(", ");
      const students = $('#callbacks').val().toString();
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
          EventBus.$emit("newEventAdded", response.data);
          swal("Congratulations!", "New Schedule added", "success");
          this.clearForm();
        } else {
          // swal(
          //   "Something went wrong :(",
          //   "Unable to add new Schedule",
          //   "error"
          // );
          console.log("Error adding new schedule", err.response);
          const errList = err.response.data.errors;
          this.errors = Object.keys(errList).reduce((object, key) => {
            object[key] = errList[key][0];
            return object;
          }, {});
        }
      });
    },
    getAllStudents() {
      fetchAll("student", (err, data) => {
        if (!err) {
          this.students = data;
          this.$nextTick(function () {
              this.loadMultiSelect();
          });
        } 
        else
          console.log("Error while fetching Students database", err.response);
      });
    },
    getAllSubjects() {
      fetchAll("subject", (err, data) => {
        if (!err) {
          this.subjects = data;
        } 
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
    },
    clearForm() {
      this.errors = "";
      this.form_data = Object.keys(this.form_data).reduce((object, key) => {
        if (key === "students") object[key] = [];
        else object[key] = "";
        return object;
      }, {});
    },
    loadMultiSelect() {
      $('#callbacks').multiSelect({
        selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Selectable Student'>",
        selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search Selected Student'>",
        afterInit: function(ms){
          var that = this,
          $selectableSearch = that.$selectableUl.prev(),
          $selectionSearch = that.$selectionUl.prev(),
          selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
          selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

          that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
          .on('keydown', function(e){
            if (e.which === 40){
              that.$selectableUl.focus();
              return false;
            }
          });

          that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
          .on('keydown', function(e){
            if (e.which == 40){
              that.$selectionUl.focus();
              return false;
            }
          });
        },
        afterSelect: function(){
          this.qs1.cache();
          this.qs2.cache();
        },
        afterDeselect: function(){
          this.qs1.cache();
          this.qs2.cache();
        }
      });
    }
  } 
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>