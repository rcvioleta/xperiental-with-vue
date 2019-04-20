import Model from './Model.js';

class EducationBackground extends Model {
    constructor(name, year_attended, notes) {
        this.name = name;
        this.slug = name;
        this.year_attended = year_attended;
        this.notes = notes;
    }
}

export default EducationBackground;