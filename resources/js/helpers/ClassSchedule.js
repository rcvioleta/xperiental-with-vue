import axios from 'axios';

class ClassSchedule {
  constructor(students, class_date, start_time, end_time, class_rate_id, subject_id, classroom_id, status) {
    this.students = students;
    this.class_date = class_date;
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

  static deleteSchedule(uri, callback) {
    axios
    .delete(uri)
    .then(response => callback(null, response.data.removedId))
    .catch(err => callback(err, null));
  }
}

export default ClassSchedule;