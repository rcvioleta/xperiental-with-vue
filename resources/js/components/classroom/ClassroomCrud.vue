<template>
  <div id="classroom">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="classroom in classrooms.data" :key="classroom.slug">
          <td>{{ classroom.name }}</td>
          <td>
            <div class="btn-group">
              <select
                class="btn btn-primary btn-sm dropdown-toggle"
                name="status"
                v-model="classroom.status"
                @change="updateStatus($event, classroom.slug, classroom.name)"
              >
                <option
                  :value="classroom.status ? 1 : 0"
                >{{ classroom.status ? 'Active' : 'Inactive' }}</option>
                <option
                  :value="classroom.status ? 0 : 1"
                >{{ classroom.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button
                type="button"
                class="btn btn-danger"
                @click="deleteClassroom(classroom.slug)"
              >Remove</button>
              <button
                type="button"
                class="btn btn-warning"
                @click="editClassroom(classroom.slug)"
              >Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <clasroom-modal
      :active="isActive"
      :name="selectedClassroom.name"
      :status="selectedClassroom.status"
      :slug="selectedClassroom.slug"
      :updateFunc="update"
    ></clasroom-modal>
  </div>
</template>

<script>
import swal from "sweetalert";

import { EventBus } from "../../app.js";
import Model from "../../helpers/Model.js";
import Modal from "../ui/modal/Modal.vue";

export default {
  data() {
    return {
      classrooms: "",
      selectedClassroom: "",
      classroomIndex: "",
      editingMode: false
    };
  },
  created() {
    Model.fetchAll("classroom", (err, data) => {
      if (!err) this.classrooms = data;
      else {
        swal("Something went wrong", "Unable to fetch classrooms", "error");
        console.log(
          "%c Unable to get classroom data from database",
          "font-weight: bold; color: red; font-family: Monaco"
        );
        console.log(err.response);
      }
    });

    EventBus.$on("newClassroomAdded", result => {
      this.classrooms.data.push(result);
      swal("Congrats!", "New classroom added", "success");
    });
  },
  components: {
    "clasroom-modal": Modal
  },
  methods: {
    updateStatus(e, slug, name) {
      const status = e.target.value;
      const payload = { name, slug, status };
      Model.update("classroom/", payload, (err, result) => {
        if (!err) {
          swal("Success!", "Successfull updated Classroom", "success");
          console.log("[updateStatus] result", result);
        } else {
          swal("Something went wrong", "Unable to update Classroom", "error");
          console.log("[UPDATE ERROR]", err.response);
        }
      });
    },
    deleteClassroom(slug) {
      swal({
        title: "Continue removing classroom?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          Model.delete("classroom/", slug, (err, removedSlug) => {
            if (!err) {
              this.classrooms.data = this.classrooms.data.filter(
                classroom => classroom.slug !== removedSlug
              );
              swal("Classroom was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedSlug);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete Classroom. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("Classroom was kept");
      });
    },
    update(e) {
      const name = e.target.name.value;
      const slug = e.target.slug.value;
      const status = e.target.status.value;
      const payload = { name, slug, status };

      Model.update("classroom/", payload, (err, update) => {
        if (!err) {
          this.classrooms.data[this.classroomIndex] = update;
          this.editingMode = false;
          console.log("[update] result", update);
          swal("Success!", "Successfully updated Classroom", "success");
        } else {
          swal("Something went wrong", "Unable to update Classroom", "error");
          console.log("[update] error", err.response);
        }
      });
    },
    editClassroom(slug) {
      console.log("EDIT SUBJECT", slug);
      this.classroomIndex = this.classrooms.data.findIndex(
        classroom => classroom.slug === slug
      );

      this.selectedClassroom = this.classrooms.data[this.classroomIndex];
      this.editingMode = true;
    }
  },
  computed: {
    isActive() {
      return {
        "in-use": this.editingMode
      };
    }
  }
};
</script>

<style>
</style>
