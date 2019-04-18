import Model from './Model';

import axios from 'axios';

class User extends Model {
    constructor(name, status, email, password, password_confirmation) {
        super(name, status);
        this.email = email;
        this.password = password;
        this.password_confirmation = password_confirmation;
    }

    static update(url, { name, slug, status, email, password }, callback) {
        axios.put(url + slug, { name, slug, status, email, password })
            .then(update => callback(null, update))
            .catch(err => callback(err, null));
    }
}

export default User;