import axios from 'axios';

class StudentLevel {
    constructor() {

    }

    static update({ name, slug, status }, callback) {
        axios
            .put("student-level/" + slug, {
                level_name: name,
                slug: name,
                status: status
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
