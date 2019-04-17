import Model from './Model';

class User extends Model {
    constructor(name, status, email, password) {
        super(name, status);
        this.email = email;
        this.password = password;
    }
}

export default User;