
require('./bootstrap');

window.Vue = require('vue');

 import students from './students/index.vue';
 import subjectAssignment from './students/subjectAssignment.vue';
 import studentList from './result/studentList.vue';
 import subjects from './subjects/index.vue';
 import gradeSettings from './gradeSettings/index.vue';
 import marksFeeding from './marksFeeding/index.vue';
 import VueResource from 'vue-resource';
 import BootstrapVue from 'bootstrap-vue';

 Vue.component('pagination', require('laravel-vue-pagination'));
 Vue.use(VueResource);
 Vue.use(BootstrapVue);
 Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr("content");


 const app = new Vue({
     el: '#app',
     components: {
         'students':  students,
         'subjects': subjects,
         'student-subjects': subjectAssignment,
         'grade-settings': gradeSettings,
         'marks-feeding': marksFeeding,
         'result-student-list': studentList,
     }
 });
