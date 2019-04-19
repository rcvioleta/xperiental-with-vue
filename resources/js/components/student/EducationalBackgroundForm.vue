<template>
  <div id="education-background">
    <h2 class="pull-left">School Attended</h2>
    <button class="btn btn-primary pull-right" @click="showFormOnAdd">
      Add History
      <i class="batch-icon batch-icon-plus"></i>
    </button>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>School Name</th>
          <th>Attended</th>
          <th>Notes</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="eduBackground in eduBackgrounds.data" :key="eduBackground.id">
          <td>{{ eduBackground.name }}</td>
          <td>{{ eduBackground.year_attended }}</td>
          <td>{{ eduBackground.notes }}</td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button
                type="button"
                class="btn btn-danger"
                @click="deleteEduBackground(eduBackground.slug)"
              >
                <i class="ml-2 batch-icon batch-icon-bin"></i>
              </button>
              <button
                type="button"
                class="btn btn-warning"
                @click="editEduBackground(eduBackground.slug)"
              >
                <i class="ml-2 batch-icon batch-icon-pencil"></i>
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- <div id="add-education-background">
      <div class="backdrop" :class="isActive" @click="closeForm"></div>
      <div class="edu-background-form" :class="isActive">
        <div class="card">
          <div class="card-header">Add Educational Background</div>
          <div class="card-body">
            <form @submit.prevent="updateEduBackground">
              <div class="form-group">
                <label for="school-name">School Name</label>
                <input
                  type="text"
                  name="name"
                  id="school-name"
                  class="form-control"
                  placeholder="School Name"
                  v-model="newEduBackground.name"
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
                  v-model="newEduBackground.year_attended"
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
                  v-model="newEduBackground.notes"
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
    </div>-->

    <edu-bg-form
      :active="activateUponEditing"
      :closeForm="closeForm"
      :method="updateEduBackground"
      :name="newEduBackground.name"
      :year_attended="newEduBackground.year_attended"
      :notes="newEduBackground.notes"
      @schoolNameChanged="newEduBackground.name = $event"
      @yearAttendedChanged="newEduBackground.year_attended = $event"
      @notesChanged="newEduBackground.notes = $event"
    />

    <edu-bg-form
      :active="activateUponAdding"
      :closeForm="closeForm"
      :method="saveEduBackground"
      :name="newEduBackground.name"
      :year_attended="newEduBackground.year_attended"
      :notes="newEduBackground.notes"
      @schoolNameChanged="newEduBackground.name = $event"
      @yearAttendedChanged="newEduBackground.year_attended = $event"
      @notesChanged="newEduBackground.notes = $event"
    />
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import Model from "../../helpers/Model.js";
import EducationBackground from "../../helpers/EducationBackground.js";
import EduBackgroundForm from "../forms/EduBackgroundForm.vue";

const fetchAll = Model.fetchAll.bind(EducationBackground);
const deleteEb = Model.delete.bind(EducationBackground);

export default {
  data() {
    return {
      eduBackgrounds: "",
      newEduBackground: {
        name: "",
        slug: "",
        year_attended: "",
        notes: ""
      },
      eduBackgroundIndex: "",
      editingMode: false,
      addingMode: false,
      errors: ""
    };
  },
  components: {
    "edu-bg-form": EduBackgroundForm
  },
  created() {
    fetchAll("education-background", (err, data) => {
      if (!err) {
        this.eduBackgrounds = data;
        console.log("fetched education background", data);
      } else {
        swal(
          "Something went wrong!",
          "Unable to fetch education backgrounds from database",
          "error"
        );
        console.log("error found", err.response);
      }
    });
  },
  methods: {
    saveEduBackground() {
      const { name, year_attended, notes } = this.newEduBackground;
      const newEducationBg = new EducationBackground(
        name,
        year_attended,
        notes
      );
      newEducationBg.saveEducation("education-background", (err, newData) => {
        if (!err) {
          this.eduBackgrounds.data.push(newData);
          this.addingMode = true;
          this.resetForm();
          swal("Congrats!", "New Education Background added.", "success");
          console.log(
            "%c Successfully added new education background",
            "font-weight: bold; font-family: Segoe UI Light; color: green"
          );
          console.log(newData);
        } else {
          this.errors = Object.keys(err.response.data.errors).map(key => {
            return [...Array(err.response.data.errors[key])].map(errorArr => {
              return Object.keys(errorArr).map(error => errorArr[error]);
            });
          });
          swal(
            "Something went wrong",
            this.errors
              .toString()
              .split(",")
              .join("\n"),
            "error"
          );
          console.log(
            "%c Cannot save education background",
            "font-weight: bold; font-family: Segoe UI Light; color: red"
          );
          console.log(err.response);
        }
      });
    },
    editEduBackground(slug) {
      this.editingMode = true;
      const selectedEduBackground = this.eduBackgrounds.data.find(
        edu => edu.slug === slug
      );
      this.newEduBackground = {
        name: selectedEduBackground.name,
        slug: selectedEduBackground.slug,
        year_attended: selectedEduBackground.year_attended,
        notes: selectedEduBackground.notes
      };
      this.eduBackgroundIndex = selectedEduBackground;
    },
    updateEduBackground(event) {
      const target = event.target;
      const name = this.newEduBackground.name;
      const slug = this.newEduBackground.slug;
      const year_attended = this.newEduBackground.year_attended;
      const notes = this.newEduBackground.notes;
      const payload = { name, slug, year_attended, notes };

      EducationBackground.update(
        "education-background/",
        payload,
        (err, update) => {
          if (!err) {
            this.eduBackgrounds.data[this.eduBackgroundIndex] = update;
            this.editingMode = false;
            this.resetForm();
            console.log("[update] result", update);
            swal(
              "Success!",
              "Successfully updated Education Background",
              "success"
            );
          } else {
            swal(
              "Something went wrong",
              "Unable to update Education Background",
              "error"
            );
            console.log("[update] error", err.response);
          }
        }
      );
    },
    deleteEduBackground(slug) {
      swal({
        title: "Continue removing this education background?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          deleteEb("education-background/", slug, (err, removedSlug) => {
            if (!err) {
              this.eduBackgrounds.data = this.eduBackgrounds.data.filter(
                eb => eb.slug !== removedSlug
              );
              swal("Education Background was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedSlug);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete Education Background. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("Education Background was kept");
      });
    },
    showFormOnAdd() {
      this.addingMode = true;
      this.resetForm();
    },
    closeForm() {
      this.editingMode = false;
      this.addingMode = false;
      this.resetForm();
    },
    resetForm() {
      Object.keys(this.newEduBackground).map(key => {
        this.newEduBackground[key] = "";
      });
    }
  },
  computed: {
    activateUponEditing() {
      return {
        "in-use": this.editingMode
      };
    },
    activateUponAdding() {
      return {
        "in-use": this.addingMode
      };
    }
  }
};
</script>

<style scoped>
</style>
