<template>
  <div class="col-md-6">
    <button class="btn btn-primary pull-right" type="submit" @click="saveStudentInfo">
      Save
      <i class="ml-2 batch-icon batch-icon-stiffy"></i>
    </button>
  </div>
</template>

<script>
import { EventBus } from "../../app.js";

export default {
  data() {
    return {
      formData: {
        personalInfo: {
          first_name: "",
          middle_name: "",
          last_name: "",
          gender: "",
          birth_date: "",
          phone_number: "",
          address: ""
        },
        emergencyContact: {
          full_name: "",
          phone_number: "",
          relationship: "",
          address: ""
        },
        educationBackground: {
          school_name: "",
          current_level: "",
          status: "",
          phone_number: "",
          address: ""
        }
      },
      emptyFields: []
    };
  },
  beforeUpdate() {
    // listen to data changes in student information form
    EventBus.$on("personalInfoAdded", payloads => {
      this.formData.personalInfo.first_name = payloads.first_name;
      this.formData.personalInfo.middle_name = payloads.middle_name;
      this.formData.personalInfo.last_name = payloads.last_name;
      this.formData.personalInfo.gender = payloads.gender;
      this.formData.personalInfo.birth_date = payloads.birth_date;
      this.formData.personalInfo.phone_number = payloads.phone_number;
      this.formData.personalInfo.address = payloads.address;
      this.emptyFields = [];
    });

    // listen to data changes in emergency contact form
    EventBus.$on("emergencyContactAdded", payloads => {
      this.formData.emergencyContact.full_name = payloads.full_name;
      this.formData.emergencyContact.phone_number = payloads.phone_number;
      this.formData.emergencyContact.relationship = payloads.relationship;
      this.formData.emergencyContact.address = payloads.address;
      this.emptyFields = [];
    });

    // listen to data changes in educational background form
    EventBus.$on("educationalBackgroundAdded", payloads => {
      this.formData.educationBackground.school_name = payloads.school_name;
      this.formData.educationBackground.current_level = payloads.current_level;
      this.formData.educationBackground.status = payloads.status;
      this.formData.educationBackground.phone_number = payloads.phone_number;
      this.formData.educationBackground.address = payloads.address;
      this.emptyFields = [];
    });
  },
  methods: {
    saveStudentInfo() {
      Object.keys(this.formData).map(formKey => {
        return [...Array(this.formData[formKey])].map(form => {
          return Object.keys(form).map(field => {
            if (!form[field]) {
              this.emptyFields.push(field);
              // console.log("[EMPTY FIELDS]", field);
            }
          });
        });
      });
      console.log("EMPTY FIELDS", this.emptyFields);
      console.log("[Saving to database]", this.formData);
    }
  }
};
</script>

<style>
</style>
