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
              <input type="hidden" name="slug">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
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

export default {
  data() {
    return {
      calendarPlugins: [dayGridPlugin, interactionPlugin],
      events: [
        {
          id: 1,
          title: "Rigen Payout",
          start: "2019-05-28"
        },
        {
          id: 2,
          title: "Bitcoin price rising",
          start: "2019-05-25"
        }
      ],
      editMode: false
    };
  },
  components: {
    FullCalendar
  },
  methods: {
    editSchedule(arg) {
      console.log("Event ID#", arg.event.id);
      console.log("Event Name#", arg.event.title);
      this.editMode = true;
    },
    updateSchedule() {
      alert("updating schedule...");
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
