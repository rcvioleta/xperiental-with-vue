<template>
  <div id="calendar">
    <FullCalendar
      defaultView="dayGridMonth"
      :events="events"
      :plugins="calendarPlugins"
      @eventClick="editSchedule"
    />

    <div id="modal">
      <div class="backdrop" :class="activated"></div>
      <div class="main-modal" :class="activated">
        <div class="card">
          <div class="card-header">
            EDIT SCHEDULE
            <span
              style="float: right; color: red; font-weight: bold; cursor: pointer;"
            >X</span>
          </div>
          <div class="card-body">
            <form @submit.prevent="updateSchedule">
              <div class="form-row pt-3">
                <div class="col-md-3">
                  <label for="validationCustom02">Class Date</label>
                  <input
                    type="date"
                    name="class_date"
                    class="fallback form-control"
                    autocomplete="off"
                    v-model="newSchedule.class_date"
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
                      v-model="newSchedule.start_time_hour"
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
                      v-model="newSchedule.start_time_minute"
                    >
                      <option disabled value>Min</option>
                      <option value="00">00</option>
                      <option value="30">30</option>
                    </select>
                    <select
                      class="custom-select"
                      name="start_time_period"
                      id="inputGroupSelect01"
                      v-model="newSchedule.start_time_period"
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
                      v-model="newSchedule.end_time_hour"
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
                      v-model="newSchedule.end_time_minute"
                    >
                      <option disabled value>Min</option>
                      <option value="00">00</option>
                      <option value="30">30</option>
                    </select>
                    <select
                      class="custom-select"
                      name="end_time_period"
                      id="inputGroupSelect01"
                      v-model="newSchedule.end_time_period"
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
                    <select
                      class="form-control"
                      name="class_rate"
                      v-model="newSchedule.class_rate_id"
                    >
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
                    <select class="form-control" name="subject" v-model="newSchedule.subject_id">
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
                    <select
                      class="form-control"
                      name="classroom"
                      v-model="newSchedule.classroom_id"
                    >
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
                    <select class="form-control" name="status" v-model="newSchedule.status">
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
                      v-model="newSchedule.students"
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
              <button class="btn btn-primary" type="submit">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import Multiselect from "vue-multiselect";

import Model from "../../helpers/Model";
import swal from "sweetalert";

const fetchAll = Model.fetchAll.bind(null);

export default {
  data() {
    return {
      calendarPlugins: [dayGridPlugin, interactionPlugin],
      events: [],
      classrooms: "",
      class_rates: "",
      subjects: "",
      students: "",
      newSchedule: "",
      editMode: false
    };
  },
  components: {
    FullCalendar,
    Multiselect
  },
  created() {
    this.fetchAllStudents();
    this.fetchAllSubjects();
    this.fetchAllSchedules();
  },
  methods: {
    editSchedule(arg) {
      console.log("Event ID#", arg.event.id);
      console.log("Event Name#", arg.event.title);
      this.editMode = true;
      this.newSchedule = this.events.find(event => event.id === +arg.event.id);
    },
    updateSchedule() {
      alert("updating schedule...");
    },
    fetchAllStudents() {
      fetchAll("student", (err, data) => {
        if (!err) this.students = data;
        else console.log("Unable to fetch students", err);
      });
    },
    fetchAllSubjects() {
      fetchAll("subject", (err, data) => {
        if (!err) this.subjects = data;
        else console.log("Unable to fetch subjects", err);
      });
    },
    fetchAllSchedules() {
      fetchAll("schedule", (err, response) => {
        if (!err && response.data.length === 0) {
          console.log(
            "Able to reach to server, but no schedule yet",
            response.data
          );
        } else if (!err && response.data.length > 0) {
          console.log("Fetched schedules", response.data);
          this.events = response.data.map(schedule => {
            const { name } = this.subjects.data.find(
              subject => subject.id === +schedule.subject_id
            );
            return {
              id: schedule.id,
              title: `${name} ${schedule.start_time}-${schedule.end_time}`,
              start: schedule.class_date
            };
          });
        } else {
          console.log("Could not fetch schedules", err);
          swal("Something went wrong :(", "Unable to fetch schedules", "error");
        }
      });
    }
  },
  computed: {
    activated() {
      return {
        "in-use": this.editMode
      };
    }
  }
};
</script>

<style scopped>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";

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
