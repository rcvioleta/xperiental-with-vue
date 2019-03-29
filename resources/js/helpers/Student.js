import axios from "axios";

class Student {
  static savePersonalInformation(data, callback) {
    axios.post('student', {
      first_name: data.first_name,
      middle_name: data.middle_name,
      last_name: data.last_name,
      gender: data.gender,
      birth_date: data.birth_date,
      phone_number: data.phone_number,
      address: data.address
    })
      .then(result => {
        callback(null, result.data.insertedId);
      })
      .catch(err => {
        callback(err.response.data, null);
        console.log('savePersonalInformation', err.response.data);
      })
  }

  static saveEmergencyContact(data, studentId, callback) {
    axios.post('emergency-contact', {
      student_info_id: studentId,
      full_name: data.full_name,
      phone_number: data.phone_number,
      relationship: data.relationship,
      address: data.address
    })
      .then(result => {
        callback(null, result.data.insertedId);
      })
      .catch(err => {
        callback(err.response.data, null);
        console.log('saveEmergencyContact', err.response.data);
      })
  }

  static saveEducationBackground(data, studentId, callback) {
    axios.post('education-background', {
      student_info_id: studentId,
      school_name: data.school_name,
      current_level: data.current_level,
      status: data.status,
      phone_number: data.phone_number,
      address: data.address
    })
      .then(result => {
        callback(null, result);
      })
      .catch(err => {
        callback(err.response.data, null);
        console.log('saveEducationalBackground', err.response.data);
      })
  }
}

export default Student;