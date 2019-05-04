import axios from "axios";

class Student {
    constructor(fname, mname, lname, gender, bday, pNumber, address) {
        this.first_name = fname;
        this.middle_name = mname;
        this.last_name = lname;
        this.gender = gender;
        this.birth_date = bday;
        this.phone_number = pNumber;
        this.address = address;
    }

    saveStudentInfo({full_name, phone_number, relationship, address }, callback) {
        axios
            .post("student", this)
            .then(result => {
                return axios.post("emergency-contact", {
                    student_info_id: result.data.insertedId,
                    full_name,
                    phone_number,
                    relationship,
                    address
                });
            })
            .then(response => callback(null, response))
            .catch(err => callback(err, null));
    }
}

export default Student;
