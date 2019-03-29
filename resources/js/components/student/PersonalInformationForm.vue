<template>
  <form @input="recordPersonalInformation">
    <div class="form-row">
      <div class="col-md-4 mb-3">
        <label for="validationCustom01">First name</label>
        <input
          type="text"
          name="first_name"
          class="form-control"
          id="validationCustom01"
          placeholder="First name"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Middle name</label>
        <input
          type="text"
          name="middle_name"
          class="form-control"
          id="validationCustom02"
          placeholder="Last name"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
      <div class="col-md-4 mb-3">
        <label for="validationCustom02">Last name</label>
        <input
          type="text"
          class="form-control"
          name="last_name"
          id="validationCustom02"
          placeholder="Last name"
          required
        >
        <div class="valid-feedback">Looks good!</div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-2 mb-3">
        <label for="validationCustom03">Gender</label>
        <div class="col-md-12 mt-2" style="padding-left: 0">
          <div
            class="custom-control custom-radio form-check form-check-inline"
            style="width:40%;float:left;"
          >
            <input
              type="radio"
              class="custom-control-input"
              id="customControlValidation2a"
              name="gender"
              value="male"
            >
            <label class="custom-control-label" for="customControlValidation2a">Male</label>
          </div>
          <div
            class="custom-control custom-radio mb-3 form-check form-check-inline"
            style="width:20%;float:left;"
          >
            <input
              type="radio"
              class="custom-control-input"
              id="customControlValidation3a"
              name="gender"
              value="female"
            >
            <label class="custom-control-label" for="customControlValidation3a">Female</label>
            <div class="invalid-feedback">More example invalid feedback text</div>
          </div>
        </div>
      </div>
      <div class="col-md-2 mb-3">
        <label for="validationCustom04">Birthdate</label>
        <input
          type="text"
          name="birth_date"
          class="fallback form-control"
          autocomplete="off"
          placeholder="DD/MM/YYYY"
        >
        <div class="invalid-feedback">Please provide a valid state.</div>
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
      <div class="col-md-6 mb-3">
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
        first_name: "",
        middle_name: "",
        last_name: "",
        gender: "",
        birth_date: "",
        phone_number: "",
        address: ""
      }
    };
  },
  methods: {
    recordPersonalInformation(e) {
      const source = e.srcElement;
      console.log("triggered");
      switch (source.name) {
        case "first_name":
          this.payloads.first_name = source.value;
          break;
        case "middle_name":
          this.payloads.middle_name = source.value;
          break;
        case "last_name":
          this.payloads.last_name = source.value;
          break;
        case "gender":
          this.payloads.gender = source.value;
          break;
        case "birth_date":
          this.payloads.birth_date = source.value;
        case "phone_number":
          this.payloads.phone_number = source.value;
        case "address":
          this.payloads.address = source.value;
      }
      EventBus.$emit("personalInfoAdded", this.payloads);
    }
  }
};
</script>

<style>
</style>
