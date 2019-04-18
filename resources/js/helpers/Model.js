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
            .then(result => callback(null, this))
            .catch(err => callback(err, null));
    }

    static updateStatus(url, callback) {
        axios.get(url)
            .then(update => callback(null, update.data))
            .catch(err => callback(err, null));
    }

    static update(url, {
        name,
        slug,
        status
    }, callback) {
        axios
            .put(url + slug, {
                name: name,
                slug: name,
                status: status
            })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

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
