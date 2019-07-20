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
                @change="updateStatus($event, classroom.slug)"
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
  </div>
</template>

<script>
import { EventBus } from "../../../app.js";
import Model from "../../../helpers/Model.js";

export default {
  data() {
    return {
      classrooms: "",
      index: ""
    };
  },
  created() {
    this.fetchClassroom();

    EventBus.$on("editingClassroomOk", () => {
      this.fetchClassroom();
    });

    EventBus.$on("newClassroomAdded", result => {
      this.classrooms.data.push(result);
      swal("Congrats!", "New classroom added", "success");
    });
  },
  methods: {
    updateStatus(e, slug) {
      const status = Number(e.target.value);
      let uri = "";

      if (status === 1) uri = `classroom/active/${slug}`;
      else uri = `classroom/inactive/${slug}`;

      Model.updateStatus(uri, (err, result) => {
        if (!err) {
          console.log("update status", result);
          swal("Congrats!", result, "success");
        } else {
          console.log("error updating status", err.response.data);
          swal(
            "Sorry... Something went wrong :(",
            "Unable to update clasroom status",
            "error"
          );
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
          Model.delete(`classroom/${slug}`, (err, removedSlug) => {
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
    editClassroom(slug) {
      console.log("EDIT SUBJECT", slug);
      this.index = this.classrooms.data.findIndex(
        classroom => classroom.slug === slug
      );
      const data = { ...this.classrooms.data[this.index] };
      const payloads = { editing: true, data };
      EventBus.$emit("editingClassroom", payloads);
    },
    fetchClassroom() {
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
    }
  }
};
</script>

<style>
</style>
