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
import EducationBackground from "../../helpers/EducationBackground.js";
import EduBackgroundForm from "../forms/EduBackgroundForm.vue";
import Model from "../../helpers/Model.js";

const fetchAllEduBg = Model.fetchAll.bind(EducationBackground);
const update = Model.update.bind(EducationBackground);
const deleteEduBg = Model.delete.bind(EducationBackground);

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
    fetchAllEduBg("education-background", (err, data) => {
      if (!err) {
        this.eduBackgrounds = data;
        console.log(
          "%c Fetch result for Education Background",
          "font-weight: bold; color: green; font-family: Segoe UI Light;"
        );
        console.log(data);
      } else {
        swal(
          "Something went wrong!",
          "Unable to fetch education backgrounds from database",
          "error"
        );
        console.log(
          "%c Error Found",
          "font-weight: bold; color: red; font-family: Segoe UI Light;"
        );
        console.log(err.response);
      }
    });
  },
  methods: {
    saveEduBackground() {
      const { name, year_attended, notes } = this.newEduBackground;
      const newEduBackground = new EducationBackground(
        name,
        year_attended,
        notes
      );
      newEduBackground.save("education-background", (err, newData) => {
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
      this.eduBackgroundIndex = this.eduBackgrounds.data.findIndex(
        edu => edu.slug === slug
      );
      const eb = this.eduBackgrounds.data[this.eduBackgroundIndex];
      this.newEduBackground = {
        name: eb.name,
        slug: eb.slug,
        year_attended: eb.year_attended,
        notes: eb.notes
      };
    },
    updateEduBackground(event) {
      const target = event.target;
      const newEb = this.newEduBackground;
      const name = newEb.name;
      const slug = newEb.slug;
      const year_attended = newEb.year_attended;
      const notes = newEb.notes;
      const uri = `education-background/${slug}`;
      const payloads = { name, slug: name, year_attended, notes };

      update(uri, payloads, (err, update) => {
        if (!err) {
          this.eduBackgrounds.data[this.eduBackgroundIndex] = update;
          this.editingMode = false;
          this.resetForm();
          swal(
            "Success!",
            "Successfully updated Education Background",
            "success"
          );
          console.log("[update] result", update);
        } else {
          swal(
            "Something went wrong",
            "Unable to update Education Background",
            "error"
          );
          console.log("[update] error", err.response);
        }
      });
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
          deleteEduBg("education-background/", slug, (err, removedSlug) => {
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
