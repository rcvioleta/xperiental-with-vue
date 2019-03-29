<template>
  <form @input="recordEmergencyForm">
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom01">Full Name</label>
        <input
          type="text"
          name="full_name"
          class="form-control"
          id="validationCustom01"
          placeholder="Full Name"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-2 mb-3">
        <label for="validationCustom05">Telephone/Phone</label>
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
      <div class="col-md-2 mb-3">
        <label for="validationCustom02">Relation to Student</label>
        <input
          type="text"
          name="relationship"
          class="form-control"
          id="validationCustom02"
          placeholder="Relationship"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Home Address</label>
        <input
          type="text"
          name="address"
          class="form-control"
          id="validationCustom02"
          placeholder="Home Address"
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
        full_name: "",
        phone_number: "",
        relationship: "",
        address: ""
      }
    };
  },
  methods: {
    recordEmergencyForm(e) {
      const source = e.srcElement;
      switch (source.name) {
        case "full_name":
          this.payloads.full_name = source.value;
          break;
        case "phone_number":
          this.payloads.phone_number = source.value;
          break;
        case "relationship":
          this.payloads.relationship = source.value;
          break;
        case "address":
          this.payloads.address = source.value;
          break;
      }
      EventBus.$emit("emergencyContactAdded", this.payloads);
    }
  }
};
</script>

<style>
</style>
