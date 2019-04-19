import axios from "axios";

class Student {
    static saveStudentInfo(formData, callback) {
        const {
            first_name,
            middle_name,
            last_name,
            gender,
            birth_date,
            phone_number,
            address
        } = formData.personalInfo;

        axios
            .post("student", {
                first_name: first_name,
                middle_name: middle_name,
                last_name: last_name,
                gender: gender,
                birth_date: birth_date,
                phone_number: phone_number,
                address: address
            })
            .then(result => {
                const { full_name, phone_number, relationship, address } = formData.emergencyContact;
                return axios.post("emergency-contact", {
                    student_info_id: result.data.insertedId,
                    full_name: full_name,
                    phone_number: phone_number,
                    relationship: relationship,
                    address: address
                });
            })
            .then(response => callback(null, response))
            .catch(err => callback(err, null));
    }
}

export default Student;
