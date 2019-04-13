/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('subject-crud', require('./components/subject/SubjectCrud.vue').default);
Vue.component('subject-form', require('./components/subject/AddSubject.vue').default);
Vue.component('add-student-button', require('./components/student/AddStudentButton.vue').default);
Vue.component('personal-information-form', require('./components/student/PersonalInformationForm.vue').default);
Vue.component('emergency-contact-form', require('./components/student/EmergencyContactForm.vue').default);
Vue.component('educational-background-form', require('./components/student/EducationalBackgroundForm.vue').default);
Vue.component('student-level-crud', require('./components/studentLevel/StudentLevelCrud.vue').default);
Vue.component('level-form', require('./components/studentLevel/AddStudentLevel.vue').default);
Vue.component('classroom-crud', require('./components/classroom/ClassroomCrud.vue').default);
Vue.component('classroom-form', require('./components/classroom/AddClassroom.vue').default);
Vue.component('class-rate-crud', require('./components/classRate/ClassRateCrud.vue').default);
Vue.component('class-rate-form', require('./components/classRate/AddClassRate.vue').default);

export const EventBus = new Vue();

// import sweetalert globally so that swal can be across files
import swal from 'sweetalert';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
