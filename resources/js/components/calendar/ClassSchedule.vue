<template>
  <div id="calendar">
    <FullCalendar
      defaultView="dayGridMonth"
      :events="events"
      :plugins="calendarPlugins"
      @eventClick="editSchedule"
    />

    <div id="modal">
      <div class="backdrop" :class="activated" @click="closeModal"></div>
      <div class="main-modal" :class="activated">
        <div class="card">
          <div class="card-header">
            EDIT SCHEDULE
            <span
              style="float: right; color: red; font-weight: bold; cursor: pointer;"
              @click="closeModal"
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
                    <select class="form-control" name="subject" v-model="newSchedule.subject">
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
                  <select class="form-control" id='callbacks2' multiple='multiple'>
                    <option v-for="student in students.data" :value="student.id">{{ student.full_name }}</option>
                  </select>
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
              <button class="btn btn-danger" @click.prevent="deleteSchedule">Delete</button>
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
import swal from "sweetalert";

import ClassSchedule from "../../helpers/ClassSchedule";
import Model from "../../helpers/Model";
import { EventBus } from "../../app";

const fetchAll = Model.fetchAll.bind(null);
const updateSchedule = Model.update.bind(null);

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
      schedules: [],
      index: "",
      editMode: false
    };
  },
  components: {
    FullCalendar,
    Multiselect
  },
  created() {
    this.initFetchingData();

    EventBus.$on("newEventAdded", event => {
      console.log("[Class Schedule] New event captured", event.data);
      const { id, class_date, subject, start_time, end_time } = event.data;
      this.events.push({
        id,
        start: class_date,
        title: `${subject} ${start_time}-${end_time}`
      });
      this.schedules.push({ ...event.data });
    });
    // console.log("hehe", this.schedule);
  },
  methods: {
    itemContains(n) {
      // console.log("Yoh", event.data);
      console.log("hehe", students.split(","));
      // alert(this.items.indexOf(n) > -1);
      // return students.split(",").indexOf(n) > -1;
    },
    editSchedule(arg) {
      console.log("Event ID#", arg.event.id);
      console.log("Event Name#", arg.event.title);
      const eventId = +arg.event.id;
      this.index = this.events.findIndex(event => event.id === eventId);
      this.editMode = true;
      const schedule = this.schedules.find(schedule => schedule.id === eventId);

      const { students, subject, start_time, end_time } = schedule;
      let filteredSubject = undefined;

      this.subjects.data.map(subj =>
        subj.name === subject ? (filteredSubject = subj.id) : null
      );

      const scheduleToUpdate = {
        ...schedule,
        subject: filteredSubject
      };

      delete scheduleToUpdate.start_time;
      delete scheduleToUpdate.end_time;

      const filteredStudents = [];

      students.split(",").map(id => {
        return this.students.data.map(student => {
          if (student.id === +id) {
            filteredStudents.push({ ...student });
          }
        });
      });

      this.newSchedule = {
        ...scheduleToUpdate,
        start_time_hour: start_time.split("")[0],
        start_time_minute: start_time.split(":")[1].split(" ")[0],
        start_time_period: start_time.split(":")[1].split(" ")[1],
        end_time_hour: end_time.split("")[0],
        end_time_minute: end_time.split(":")[1].split(" ")[0],
        end_time_period: end_time.split(":")[1].split(" ")[1],
        students: filteredStudents
      };

      console.log("Schedule to update", this.newSchedule);
    },
    updateSchedule() {
      const excludedProps = [
        "start_time_hour",
        "start_time_minute",
        "start_time_period",
        "end_time_hour",
        "end_time_minute",
        "end_time_period"
      ];

      const newSchedule = Object.keys(this.newSchedule).reduce(
        (object, key) => {
          if (!excludedProps.includes(key)) {
            if (key === "students") {
              object[key] = this.newSchedule[key]
                .map(student => student.id)
                .toString()
                .split(", ")
                .join(", ");
            } else {
              object[key] = this.newSchedule[key];
            }
          }
          return object;
        },
        {}
      );

      const uri = `/admin/schedule/${newSchedule.id}`;
      console.log("new schedules", newSchedule);

      updateSchedule(uri, newSchedule, (err, update) => {
        if (!err) {
          console.log("success update", update);
          const updatedSchedule = [...this.events];
          const { start_time, end_time, subject, id, class_date } = update;
          updatedSchedule[this.index] = {
            id,
            title: `${subject} ${start_time}-${end_time}`,
            start: class_date
          };
          this.events = updatedSchedule;
          this.closeModal();
          swal("Success!", "Schedule was updated", "success");
        } else {
          console.log("update error", err.response.data);
          swal("Something went wrong :(", "Unable to update schedule", "error");
        }
      });
    },
    deleteSchedule(arg) {
      console.log("delete ID#:", this.newSchedule.id);
      ClassSchedule.deleteSchedule(
        `/admin/schedule/${this.newSchedule.id}`,
        (err, removedId) => {
          if (!err) {
            console.log("removed ID", +removedId);
            this.events = this.events.filter(event => event.id !== +removedId);
            this.editMode = false;
            this.newSchedule = "";
            swal("Success!", "Schedule was removed", "success");
          } else {
            console.log("error found during deletion process", err);
            swal(
              "Something went wrong :(",
              "Unable to delete schedule",
              "error"
            );
          }
        }
      );
    },
    showOptions(arg) {
      // swal("Please let me know what action you'd like to do?", {
      //   buttons: {
      //     cancel: "Cancel",
      //     edit: {
      //       text: "Edit",
      //       value: "edit"
      //     },
      //     delete: true
      //   }
      // }).then(value => {
      //   switch (value) {
      //     case "delete":
      //       this.deleteSchedule(arg);
      //       break;
      //     case "edit":
      //       this.editSchedule(arg);
      //       break;
      //     default:
      //       swal("No actions performed!");
      //   }
      // });
    },
    fetchAllStudents() {
      fetchAll("student", (err, data) => {
        if (!err) {
          this.students = data;
          console.log("[Done] Fetching students");
          this.$nextTick(function () {
              this.loadMultiSelect();
          });
        } else console.log("Unable to fetch students", err);
      });
    },
    fetchAllClassrooms() {
      fetchAll("classroom", (err, data) => {
        if (!err) {
          this.classrooms = data;
          console.log("[Done] Fetching classrooms");
        } else console.log("Unable to fetch classrooms", err);
      });
    },
    fetchAllClassRates() {
      fetchAll("class-rate", (err, data) => {
        if (!err) {
          this.class_rates = data;
          console.log("[Done] Fetching class rates");
        } else console.log("Unable to fetch class rates", err);
      });
    },
    fetchAllSubjects() {
      fetchAll("subject", (err, data) => {
        if (!err) {
          this.subjects = data;
          console.log("[Done] Fetching subjects");
        } else console.log("Unable to fetch subjects", err);
      });
    },
    fetchAllSchedules() {
      fetchAll("schedule", (err, response) => {
        if (!err) {
          this.schedules = response.data;
          this.events = response.data.map(event => {
            return {
              id: event.id,
              title: `${event.subject} ${event.start_time} - ${event.end_time}`,
              start: event.class_date
            };
          });
          console.log("[Done] Fetching schedules");
          console.log("Fetched schedules", response.data);
        } else {
          console.log("Could not fetch schedules", err);
          swal("Something went wrong :(", "Unable to fetch schedules", "error");
        }
      });
    },
    initFetchingData() {
      this.fetchAllStudents();
      this.fetchAllClassRates();
      this.fetchAllClassrooms();
      this.fetchAllSubjects();
      this.fetchAllSchedules();
    },
    closeModal() {
      this.editMode = false;
      this.newSchedule = "";
      this.index = "";
    },
    loadMultiSelect() {
      $('#callbacks2').multiSelect({
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
  z-index: 900;
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

.danger-background {
  background-color: #ff8080 !important;
}

.fc-right {
  display: flex;
}

@media (min-width: 48em) {
  .main-modal {
    width: 50%;
  }
}
</style>
