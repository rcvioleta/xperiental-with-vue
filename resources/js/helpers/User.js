import Model from './Model';

class User extends Model {
    constructor(name, status, email, password, password_confirmation) {
        super(name, status);
        this.email = email;
        this.password = password;
        this.password_confirmation = password_confirmation;
    }
}

export default User;