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
    // listen to data changes in student information form
    EventBus.$on("personalInfoAdded", payloads => {
      this.savePayloads(this.formData.personalInfo, payloads);
      this.emptyFields = [];
    });

    // listen to data changes in emergency contact form
    EventBus.$on("emergencyContactAdded", payloads => {
      this.savePayloads(this.formData.emergencyContact, payloads);
      this.emptyFields = [];
    });

    // listen to data changes in educational background form
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
        // save to database
        Student.savePersonalInformation(
          this.formData.personalInfo,
          (err, data) => {
            if (err) {
              swal("Something went wrong", err, "error");
            } else {
              Student.saveEmergencyContact(
                this.formData.emergencyContact,
                data,
                (err, data) => {
                  if (err) {
                    swal("Something went wrong", err, "error");
                  } else {
                    Student.saveEducationBackground(
                      this.formData.educationBackground,
                      data,
                      (err, data) => {
                        if (err) {
                          swal("Something went wrong", err, "error");
                        } else {
                          swal("Success!", "New Student added", "success");
                        }
                      }
                    );
                  }
                }
              );
            }
          }
        );
      }

      console.log("EMPTY FIELDS", this.emptyFields);
      console.log("[Saving to database]", this.formData);
    },
    savePayloads(formData, payloads) {
      Object.keys(formData).map(key => {
        formData[key] = payloads[key];
      });
    },
    validateForm(formData) {
      Object.keys(formData).map(formKey => {
        return [...Array(formData[formKey])].map(form => {
          return Object.keys(form).map(field => {
            if (!form[field]) this.emptyFields.push(field);
          });
        });
      });
    }
  }
};
</script>

<style>
</style>
