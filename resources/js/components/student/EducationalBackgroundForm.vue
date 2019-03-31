<template>
  <form @input="recordEducationForm">
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom01">School Name</label>
        <input
          type="text"
          name="school_name"
          class="form-control"
          id="validationCustom01"
          placeholder="School name"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Current Level</label>
        <div class="form-group">
          <select name="current_level" class="form-control">
            <option value>Select Level</option>
            <option value="Grade 1">Grade 1</option>
            <option value="Grade 2">Grade 2</option>
            <option value="Grade 3">Grade 3</option>
            <option value="Grade 4">Grade 4</option>
            <option value="Grade 5">Grade 5</option>
          </select>
        </div>
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Student Status</label>
        <div class="form-group">
          <select name="status" class="form-control">
            <option value>Select Status</option>
            <option value="Ongoing">Ongoing</option>
            <option value="Graduated">Graduated</option>
          </select>
        </div>
        <div class="valid-feedback">Looks good!</div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom05">Shool Telephone/Cellphone</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupPrepend-6">
              <i class="batch-icon batch-icon-headphones"></i>
            </span>
          </div>
          <input
            type="text"
            name="phone_number"
            class="sp_celphones form-control"
            autocomplete="off"
            placeholder="(63) 921-8621-999"
            aria-describedby="inputGroupPrepend-6"
          >
        </div>
        <div class="invalid-feedback">Please provide a valid zip.</div>
      </div>
      <div class="col-md-8 mb-3">
        <label for="validationCustom02">School Address</label>
        <input
          type="text"
          name="address"
          class="form-control"
          id="validationCustom02"
          placeholder="School Address"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
    </div>
  </form>
</template>

<script>
import { EventBus } from "../../app.js";

export default {
  data() {
    return {
      payloads: {
        school_name: "",
        current_level: "",
        status: "",
        phone_number: "",
        address: ""
      }
    };
  },
  methods: {
    recordEducationForm(e) {
      const source = e.srcElement;
      console.log(
        "%c Saving education background",
        "color: green; font-family: Monaco"
      );
      switch (source.name) {
        case "school_name":
          this.payloads.school_name = source.value;
          break;
        case "current_level":
          this.payloads.current_level = source.value;
          break;
        case "status":
          this.payloads.status = source.value;
          break;
        case "phone_number":
          this.payloads.phone_number = source.value;
          break;
        case "address":
          this.payloads.address = source.value;
          break;
      }
      EventBus.$emit("educationalBackgroundAdded", this.payloads);
    }
  }
};
</script>

<style>
</style>
