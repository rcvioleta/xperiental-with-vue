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
import Student from "../../helpers/Student.js";

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
  created() {
    EventBus.$on("personalInfoAdded", payloads => {
      this.savePayloads(this.formData.personalInfo, payloads);
      this.emptyFields = [];
    });

    EventBus.$on("emergencyContactAdded", payloads => {
      this.savePayloads(this.formData.emergencyContact, payloads);
      this.emptyFields = [];
    });

    EventBus.$on("educationalBackgroundAdded", payloads => {
      this.savePayloads(this.formData.educationBackground, payloads);
      this.emptyFields = [];
    });
  },
  methods: {
    saveStudentInfo() {
      this.validateForm(this.formData);
      if (this.emptyFields.length > 0) {
        swal(
          "Missing information!",
          'Please fill in the forms before clicking "SAVE"',
          "error"
        );
      } else {
        const formData = {
          personalInfo: this.formData.personalInfo,
          emergencyContact: this.formData.emergencyContact,
          educationBackground: this.formData.educationBackground
        };
        Student.saveStudentInfo(formData, (err, response) => {
          if (!err) {
            console.log("Student Saved", response);
            swal("Success!", "Successfully saved information", "success");
          } else {
            if (err.response.status === 404) {
              swal(
                "Something went wrong!",
                "Cannot connect to our server!",
                "error"
              );
            }
          }
        });
      }
      console.log("%c Empty Fields", "color: red; font-family: Monaco");
      console.table(this.emptyFields);

      console.log("%c Saving to database", "color: green; font-family: Monaco");
      console.log(this.formData);
    },
    savePayloads(formData, payloads) {
      Object.keys(formData).map(key => (formData[key] = payloads[key]));
    },
    validateForm(formData) {
      console.time("Validating form data takes");
      Object.keys(formData).map(formKey => {
        return [...Array(formData[formKey])].map(form => {
          return Object.keys(form).map(field => {
            if (!form[field]) this.emptyFields.push(field);
          });
        });
      });
      console.timeEnd("Validating form data takes");
    }
  }
};
</script>

<style>
</style>
