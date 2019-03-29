class Subject {
    constructor(name, status) {
        this.name = name;
        this.slug = name;
        this.status = status
    }

    static getSubjects(callback) {
        axios
            .get("subject")
            .then(response => {
                callback(response.data)
            })
            .catch(err => {
                console.log('[FETCH SUBJECTS ERROR]', err.response.data);
                swal("Something went wrong", 'Unable to fetch subjects', "error");
            });
    }

    save(callback) {
        axios
            .post('subject', this)
            .then(result => {
                console.log('[SAVE RESULT]', this);
                callback(this);
            }).catch(err => {
                console.log('[SAVE SUBJECT ERROR]', err.response.data);
                swal("Something went wrong", 'Cannot save subject', "error");
            });
    }

    static update(payload, callback) {
        axios
            .put("subject/" + payload.slug, {
                name: payload.name,
                slug: payload.name,
                status: payload.status
            })
            .then(result => {
                // callback(payload);
                callback(result.data.update);
            })
            .catch(err => {
                swal("Something went wrong", 'Unable to update subject', "error");
                console.log('[UPDATE ERROR]', err.response.data);
            });
    }

    static delete(slug, callback) {
        axios
            .delete("subject/" + slug)
            .then(result => {
                // use callback to capture response
                callback(result.data.slug);

                swal("Subject was removed!", {
                    icon: "success"
                });
                console.log('DELETE RESULT', result);
            })
            .catch(err => {
                swal("Something went wrong", 'Unable to delete subject', "error");
                console.log('[DELETE ERROR]', err.response.data);
            });
    }
}

export default Subject
