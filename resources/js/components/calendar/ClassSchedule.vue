<template>
  <div id="calendar">
    <FullCalendar
      defaultView="dayGridMonth"
      :events="events"
      :plugins="calendarPlugins"
      @eventClick="editSchedule"
    />
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
      ]
    };
  },
  components: {
    FullCalendar
  },
  methods: {
    editSchedule(arg) {
      console.log("Event ID#", arg.event.id);
      console.log("Event Name#", arg.event.title);
    }
  }
};
</script>

<style>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
</style>
