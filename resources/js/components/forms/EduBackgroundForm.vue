<template>
  <div id="add-education-background">
    <div class="backdrop" :class="active" @click="closeForm"></div>
    <div class="edu-background-form" :class="active">
      <div class="card">
        <div class="card-header">{{ name ? 'Edit' : 'Add' }} Educational Background</div>
        <div class="card-body">
          <form @submit.prevent="method">
            <div class="form-group">
              <label for="school-name">School Name</label>
              <input
                type="text"
                name="name"
                id="school-name"
                class="form-control"
                placeholder="School Name"
                :value="name"
                @input="updateSchoolName"
              >
            </div>

            <div class="form-group">
              <label for="attended">Attended</label>
              <input
                type="text"
                name="attended"
                id="attended"
                class="form-control"
                placeholder="e.g. 2010-2011"
                :value="year_attended"
                @input="updateYearAttended"
              >
            </div>

            <div class="form-group">
              <label for="notes">Notes</label>
              <textarea
                name="notes"
                id="notes"
                cols="30"
                rows="10"
                class="form-control"
                :value="notes"
                @input="updateNotes"
              ></textarea>
            </div>

            <div class="form-group mt-4">
              <button type="submit" class="btn btn-primary">
                Save Educational Background
                <i class="ml-2 batch-icon batch-icon-stiffy"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["active", "method", "closeForm", "name", "year_attended", "notes"],
  data() {
    return {
      newEduBackground: {
        name: "",
        year_attended: "",
        notes: ""
      }
    };
  },
  methods: {
    updateSchoolName(event) {
      this.newEduBackground.name = event.target.value;
      this.$emit("schoolNameChanged", this.newEduBackground.name);
    },
    updateYearAttended(event) {
      this.newEduBackground.year_attended = event.target.value;
      this.$emit("yearAttendedChanged", this.newEduBackground.year_attended);
    },
    updateNotes(event) {
      this.newEduBackground.notes = event.target.value;
      this.$emit("notesChanged", this.newEduBackground.notes);
    }
  }
};
</script>

<style scoped>
.edu-background-form {
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
  background: rgba(0, 0, 0, 0.5);
  display: none;
}

.edu-background-form.in-use,
.backdrop.in-use {
  display: block;
}

@media (min-width: 48em) {
  .edu-background-form {
    width: 30%;
  }
}
</style>
