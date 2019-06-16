import Model from './Model.js';

class ClassRate extends Model {
    constructor(name, status, rate) {
        super(name, status);
        this.rate = rate;
    }
}

export default ClassRate
