<template>
  <div id="add-education-background">
    <div class="backdrop" :class="active" @click="closeForm"></div>
    <div class="edu-background-form" :class="active">
      <div class="card">
        <div class="card-header">Edit Student Information</div>
        <div class="card-body">
          <form @submit.prevent="method" @input="updateStudentInfo">
            <div class="form-group" v-for="(input, index) in formInputs" :key="index">
              <label :for="input.id">{{ input.title }}</label>
              <input
                :type="input.type"
                :name="input.name"
                class="form-control"
                :id="input.id"
                :placeholder="input.title"
                :value="formData[input.name]"
              >
            </div>
            <div style="padding-left: 0">
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
            <div class="form-group mt-4">
              <button type="submit" class="btn btn-primary">
                Update Student Information
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
  props: ["active", "method", "closeForm", "formData"],
  data() {
    return {
      formInputs: {
        firstName: {
          type: "text",
          name: "first_name",
          id: "first-name",
          title: "First Name"
        },
        middleName: {
          type: "text",
          name: "middle_name",
          id: "middle-name",
          title: "Middle Name"
        },
        lastName: {
          type: "text",
          name: "last_name",
          id: "last-name",
          title: "Last Name"
        },
        birthDate: {
          type: "text",
          name: "birth_date",
          id: "birth-date",
          title: "Birth Date"
        },
        phoneNumber: {
          type: "text",
          name: "phone_number",
          id: "phone-number",
          title: "Telephone/Phone Number"
        },
        address: {
          type: "text",
          name: "address",
          id: "address",
          title: "Address"
        }
      }
    };
  },
  methods: {
    updateStudentInfo(event) {
      console.log("@input triggered", event.srcElement.name);
      switch (event.srcElement.name) {
        case "first_name":
          this.$emit("fnameChanged", event.target.value);
          break;
        case "middle_name":
          this.$emit("mnameChanged", event.target.value);
          break;
        case "last_name":
          this.$emit("lnameChanged", event.target.value);
          break;
        case "gender":
          this.$emit("genderChanged", event.target.value);
          break;
        case "birth_date":
          this.$emit("bdayChanged", event.target.value);
          break;
        case "phone_number":
          this.$emit("pnumberChanged", event.target.value);
          break;
        case "address":
          this.$emit("addressChanged", event.target.value);
          break;
      }
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
