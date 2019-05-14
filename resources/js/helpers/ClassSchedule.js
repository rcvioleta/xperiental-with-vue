import axios from 'axios';

class ClassSchedule {
  constructor(student_information_id, class_date_id, start_time, end_time, class_rate_id, subject_id, classroom_id, status) {
    this.student_information_id = student_information_id;
    this.class_date_id = class_date_id;
    this.start_time = start_time;
    this.end_time = end_time;
    this.class_rate_id = class_rate_id;
    this.subject_id= subject_id;
    this.classroom_id = classroom_id;
    this.status = status;
  }

  saveClassSchedule(uri, callback) {
    axios
      .post(uri, this)
      .then(response => callback(null, response))
      .catch(err => callback(err, null)); 
  }
}

export default ClassSchedule;