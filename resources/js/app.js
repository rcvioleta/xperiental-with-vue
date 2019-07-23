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

Vue.component('side-bar', require('./components/layout/sidebar.vue').default);

Vue.component('subject-crud', require('./components/configuration/subject/SubjectCrud.vue').default);
Vue.component('subject-form', require('./components/configuration/subject/AddSubject.vue').default);

Vue.component('level-crud', require('./components/configuration/studentLevel/StudentLevelCrud.vue').default);
Vue.component('level-form', require('./components/configuration/studentLevel/AddStudentLevel.vue').default);

Vue.component('classroom-crud', require('./components/configuration/classroom/ClassroomCrud.vue').default);
Vue.component('classroom-form', require('./components/configuration/classroom/AddClassroom.vue').default);

Vue.component('class-rate-crud', require('./components/configuration/classRate/ClassRateCrud.vue').default);
Vue.component('class-rate-form', require('./components/configuration/classRate/AddClassRate.vue').default);

Vue.component('user-crud', require('./components/configuration/user/UserCrud.vue').default);
Vue.component('user-form', require('./components/configuration/user/AddUser.vue').default);

Vue.component('student-list', require('./components/student/StudentList.vue').default);
Vue.component('student-educational-list', require('./components/student/StudentEducationalList.vue').default);

Vue.component('student-account-list', require('./components/student-account/StudentAccountList.vue').default);
Vue.component('student-account-details', require('./components/student-account/StudentAccountDetails.vue').default);
Vue.component('student-account-class-list', require('./components/student-account/StudentAccountClassList.vue').default);

Vue.component('class-calendar', require('./components/class-calendar/ClassCalendar.vue').default);

Vue.component('revenue-forecast', require('./components/dashboard/RevenueForecast.vue').default);

Vue.component('instructor-list', require('./components/instructor/InstructorList.vue').default);


export const EventBus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/* Bootstrap-vue */
import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)

import ElementUI from 'element-ui';

// import 'element-ui/lib/theme-chalk/index.css';
// import { Transfer, Select, Option } from 'element-ui';
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale';

locale.use(lang);
Vue.use(ElementUI);
// Vue.component(Transfer.name, Transfer);
// Vue.component(Select.name, Select);
// Vue.component(Option.name, Option);

// import swal from 'sweetalert2';
import swal from "sweetalert";
// window.swal = swal;

const app = new Vue({
    el: '#app'
});