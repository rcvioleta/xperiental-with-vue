
require('./bootstrap');

window.Vue = require('vue');

window.Event = new Vue();

import VueRouter from 'vue-router'

Vue.use(VueRouter)	

let routes = [
  { path: '/', component: require('./components/dashboard/Dashboard.vue').default },
  { path: '/classschedule', component: require('./components/class-calendar/ClassCalendar.vue').default },
  { path: '/studentmanagement', component: require('./components/student/StudentList.vue').default },
  { path: '/studentmanagement/create', component: require('./components/student/StudentCreate.vue').default },
  { path: '/studentmanagement/edit/:id', component: require('./components/student/StudentEdit.vue').default, props: true },
  { path: '/studentaccount', component: require('./components/student-account/StudentAccountList.vue').default },
  { path: '/studentaccount/edit/:id', component: require('./components/student-account/StudentAccountEdit.vue').default, props: true },
  { path: '/studentaccount/edit/registration/:id', component: require('./components/student-account/StudentAccountRegistrationEdit.vue').default, props: true },
  { path: '/instructor', component: require('./components/instructor/InstructorList.vue').default },
  { path: '/instructor/create', component: require('./components/instructor/InstructorCreate.vue').default },
  { path: '/instructor/edit/:id', component: require('./components/instructor/InstructorEdit.vue').default, props: true },
  { path: '/configuration', component: require('./components/configuration/ConfigurationIndex.vue').default },
]

const router = new VueRouter({
	// mode: 'history',
  routes
})

Vue.component('side-bar', require('./components/layout/sidebar.vue').default);
// Vue.component('revenue-forecast', require('./components/dashboard/RevenueForecast.vue').default);

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
  el: '#app',
  router
});