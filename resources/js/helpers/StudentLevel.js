import axios from 'axios';

class StudentLevel {
    constructor() {

    }

    static update(payload, callback) {
        axios
            .put("student-level/" + payload.slug, {
                level_name: payload.level_name,
                slug: payload.name,
                status: payload.status
            })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

    static delete(slug, callback) {
        axios
            .delete("student-level/" + slug)
            .then(result => callback(null, result.data.slug))
            .catch(err => callback(err, null));
    }
}

export default StudentLevel;
