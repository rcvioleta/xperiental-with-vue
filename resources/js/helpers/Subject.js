class Subject {
    constructor(name, status) {
        this.name = name;
        this.slug = name;
        this.status = status
    }

    static getSubjects(callback) {
        axios
            .get("subject")
            .then(response => callback(null, response.data))
            .catch(err => callback(err, null));
    }

    save(callback) {
        axios
            .post('subject', this)
            .then(result => {
                console.log('[SAVE RESULT]', this);
                callback(null, this);
            }).catch(err => callback(err, null));
    }

    static update(payload, callback) {
        axios
            .put("subject/" + payload.slug, {
                name: payload.name,
                slug: payload.name,
                status: payload.status
            })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

    static delete(slug, callback) {
        axios
            .delete("subject/" + slug)
            .then(result => callback(null, result.data.slug))
            .catch(err => callback(err, null));
    }
}

export default Subject
