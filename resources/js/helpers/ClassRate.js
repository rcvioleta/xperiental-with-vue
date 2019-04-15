import Model from './Model.js';

class ClassRate extends Model {
    constructor(name, status, rate) {
        super(name, status);
        this.rate = rate;
    }

    static update(url, {
        name,
        slug,
        rate,
        status
    }, callback) {
        axios
            .put(url + slug, {
                name: name,
                slug: name,
                rate: rate,
                status: status
            })
            .then(result => callback(null, result.data.update))
            .catch(err => callback(err, null));
    }

}

export default ClassRate
