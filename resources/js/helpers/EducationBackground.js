import axios from 'axios';

class EducationBackground {
    constructor(name, year_attended, notes) {
        this.name = name;
        this.slug = name;
        this.year_attended = year_attended;
        this.notes = notes;
    }

    saveEducation(url, callback) {
        axios.post(url, this)
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

    update(url, { name, slug, year_attended, notes }, callback) {
        axios.put(url + slug, { name, slug: name, year_attended, notes })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }
}

export default EducationBackground;