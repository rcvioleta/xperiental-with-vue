import axios from "axios";

class Student {
    static saveStudentInfo(formData) {
        axios
            .post("student", {
                first_name: formData.personalInfo.first_name,
                middle_name: formData.personalInfo.middle_name,
                last_name: formData.personalInfo.last_name,
                gender: formData.personalInfo.gender,
                birth_date: formData.personalInfo.birth_date,
                phone_number: formData.personalInfo.phone_number,
                address: formData.personalInfo.address
            })
            .then(result => {
                return axios.post("emergency-contact", {
                    student_info_id: result.data.insertedId,
                    full_name: formData.emergencyContact.full_name,
                    phone_number: formData.emergencyContact.phone_number,
                    relationship: formData.emergencyContact.relationship,
                    address: formData.emergencyContact.address
                });
            })
            .then(result => {
                return axios.post("education-background", {
                    student_info_id: result.data.insertedId,
                    school_name: formData.educationBackground.school_name,
                    current_level: formData.educationBackground.current_level,
                    status: formData.educationBackground.status,
                    phone_number: formData.educationBackground.phone_number,
                    address: formData.educationBackground.address
                });
            })
            .then(response => {
                console.log('Student Saved', response);
                swal('Success!', 'Successfully saved information', 'success');
            })
            .catch(err => {
                if (err.response.status === 404) {
                    swal('Something went wrong!', 'Cannot connect to our server!', 'error');
                }
            });
    }
}

export default Student;
