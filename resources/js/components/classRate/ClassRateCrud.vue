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
                @click="editClassroom(classRate.slug)"
              >Edit</button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
    <classrate-modal
      :active="isActive"
      :name="selectedClassRate.name"
      :rate="selectedClassRate.rate"
      :status="selectedClassRate.status"
      :slug="selectedClassRate.slug"
      :updateFunc="update"
    ></classrate-modal>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";
import ClassRate from "../../helpers/ClassRate.js";
import Modal from "../ui/modal/Modal.vue";

export default {
  data() {
    return {
      classRates: "",
      selectedClassRate: "",
      classRateIndex: "",
      editingMode: false
    };
  },
  components: {
    "classrate-modal": Modal
  },
  created() {
    ClassRate.fetchAll("class-rate", (err, data) => {
      console.log(
        "%c Fetched Data:",
        "font-family: Monaco; color: yellow; font-weight: bold;"
      );
      console.log(data);
      this.classRates = data;
    });

    EventBus.$on("newClassRateAdded", newClassRate => {
      this.classRates.data.push(newClassRate);
      swal("Congrats!", "New class rate added", "success");
    });

    EventBus.$on("closeModalEvent", () => {
      this.editingMode = false;
    });
  },
  methods: {
    updateStatus(e, slug) {
      const status = Number(e.target.value);
      let uri = "";

      if (status === 1) uri = `class-rate/active/${slug}`;
      else uri = `class-rate/inactive/${slug}`;

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
          ClassRate.delete("class-rate/", slug, (err, removedSlug) => {
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
    editClassroom(slug) {
      console.log("EDIT CLASS RATE", slug);
      this.classRateIndex = this.classRates.data.findIndex(
        rate => rate.slug === slug
      );

      this.selectedClassRate = this.classRates.data[this.classRateIndex];
      this.editingMode = true;
    },
    update(e) {
      const target = e.target;
      const name = target.name.value;
      const slug = target.slug.value;
      const status = target.status.value;
      const rate = target.rate.value;
      const uri = `class-rate/${slug}`;
      const payloads = { name, slug: name, status, rate };

      ClassRate.update(uri, payloads, (err, update) => {
        if (!err) {
          this.classRates.data[this.classRateIndex] = update;
          this.editingMode = false;
          console.log("[update] result", update);
          swal("Success!", "Successfully updated Class Rate", "success");
        } else {
          swal("Something went wrong", "Unable to update Class Rate", "error");
          console.log("[update] error", err.response);
        }
      });
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
