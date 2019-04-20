// CRUD functionality that can be applied to Subject, Classroom and Student Level

import axios from 'axios';

class Model {
    constructor(name, status) {
        this.name = name;
        this.slug = name;
        this.status = status;
    }

    save(url, callback) {
        axios
            .post(url, this)
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

    static updateStatus(url, callback) {
        axios.get(url)
            .then(update => callback(null, update.data))
            .catch(err => callback(err, null));
    }

    static update(url, payloads, callback) {
        axios
            .put(url, { ...payloads })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

    // needs to be updated so that we do not have to pass slug when invoking the function
    // proposed update static(url, callback)
    static delete(url, slug, callback) {
        axios
            .delete(url + slug)
            .then(result => callback(null, result.data.slug))
            .catch(err => callback(err, null));
    }

    static fetchAll(url, callback) {
        axios
            .get(url)
            .then(response => callback(null, response.data))
            .catch(err => callback(err, null));
    }
}

export default Model
