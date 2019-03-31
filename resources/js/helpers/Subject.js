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

    static update({ name, slug, status }, callback) {
        axios
            .put("subject/" + slug, {
                name: name,
                slug: name,
                status: status
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
