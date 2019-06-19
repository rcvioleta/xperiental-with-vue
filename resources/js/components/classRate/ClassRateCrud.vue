<template>
  <div id="class-rate">
    <table id="datatable-1" class="table table-datatable table-striped table-hover">
      <thead>
        <tr>
          <th>Name</th>
          <th>Rate</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="classRate in classRates.data" :key="classRate.slug">
          <td>{{ classRate.name.charAt(0).toUpperCase() + classRate.name.slice(1) }}</td>
          <td>{{ classRate.rate }}</td>
          <td>
            <div class="btn-group">
              <select
                class="btn btn-primary btn-sm dropdown-toggle"
                v-model="classRate.status"
                @change="updateStatus($event, classRate.slug)"
              >
                <option
                  :value="classRate.status ? 1 : 0"
                >{{ classRate.status ? 'Active' : 'Inactive' }}</option>
                <option
                  :value="classRate.status ? 0 : 1"
                >{{ classRate.status ? 'Inactive' : 'Active' }}</option>
              </select>
            </div>
          </td>
          <td>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
              <button
                type="button"
                class="btn btn-danger"
                @click="deleteClassRate(classRate.slug)"
              >Remove</button>
              <button
                type="button"
                class="btn btn-warning"
                @click="editClassRate(classRate.slug)"
              >Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import ClassRate from "../../helpers/ClassRate.js";

export default {
  data() {
    return {
      classRates: "",
      index: ""
    };
  },
  created() {
    this.fetchClassRate();

    EventBus.$on("newClassRateAdded", newClassRate => {
      this.classRates.data.push(newClassRate);
      swal("Congrats!", "New class rate added", "success");
    });

    EventBus.$on("editingClassRateOk", () => {
      this.fetchClassRate();
    });
  },
  methods: {
    updateStatus(e, slug) {
      const status = Number(e.target.value);
      let uri = "";

      if (status === 1) uri = `/class-rate/active/${slug}`;
      else uri = `/class-rate/inactive/${slug}`;

      ClassRate.updateStatus(uri, (err, result) => {
        if (!err) {
          console.log("update status", result);
          swal("Congrats!", result, "success");
        } else {
          console.log("error updating status", err.response.data);
          swal(
            "Sorry... Something went wrong :(",
            "Unable to update class rate status",
            "error"
          );
        }
      });
    },
    deleteClassRate(slug) {
      swal({
        title: "Continue removing class rate?",
        text: "There's no going back!",
        icon: "warning",
        buttons: true,
        dangerMode: true
      }).then(willDelete => {
        if (willDelete) {
          ClassRate.delete(`class-rate/${slug}`, (err, removedSlug) => {
            if (!err) {
              this.classRates.data = this.classRates.data.filter(
                rate => rate.slug !== removedSlug
              );
              swal("Class Rate was removed!", { icon: "success" });
              console.log("DELETE RESULT", removedSlug);
            } else {
              swal(
                "Something went wrong",
                `Unable to delete Class Rate. \n ${err.message}`,
                "error"
              );
              console.log("[DELETE ERROR]", err.response);
            }
          });
        } else swal("Class Rate was kept");
      });
    },
    editClassRate(slug) {
      console.log("EDIT CLASS RATE", slug);
      this.index = this.classRates.data.findIndex(rate => rate.slug === slug);

      const data = { ...this.classRates.data[this.index] };
      // send updates to AddClassRate component
      const payloads = { editing: true, data };
      EventBus.$emit("editingClassRate", payloads);
    },
    fetchClassRate() {
      ClassRate.fetchAll("class-rate", (err, data) => {
        if (!err) this.classRates = data;
        else {
          console.log("[FETCH CLASS RATES ERROR]", err.response);
          swal("Something went wrong", "Unable to fetch class rates", "error");
        }
      });
    }
  }
};
</script>
<style>
</style>
