
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 import VueRouter from 'vue-router';
  window.Vue.use(VueRouter);
  import VueSwal from 'vue-swal'
  import Spinner from 'vue-simple-spinner'
  import Vue from 'vue'
  import vSelect from 'vue-select'

  window.Vue.use(VueSwal)
  window.Vue.use(Spinner)

 Vue.component('v-select', vSelect)
 Vue.component('vue-simple-spinner',require('vue-simple-spinner'))
 Vue.component('selectize-component', require('vue2-selectize'));
 Vue.component('vue-pagination', require('laravel-vue-pagination'));
 Vue.component('ckeditor', require('vue-ckeditor2'));


 import CompanyIndex from './components/company/CompanyIndex.vue';
 import CompanyCreate from './components/company/CompanyCreate.vue';
 import CompanyEdit from './components/company/CompanyEdit.vue';
 import HalamanIndex from './components/halaman/HalamanIndex.vue';
 import HalamanCreate from './components/halaman/HalamanCreate.vue';
 import HalamanEdit from './components/halaman/HalamanEdit.vue';
 import MenuIndex from './components/menu/MenuIndex.vue';
 import MenuCreate from './components/menu/MenuCreate.vue';
 import MenuEdit from './components/menu/MenuEdit.vue';

  const routes = [
    {
  	path: '/',
  	  components: {
  		companyIndex: CompanyIndex
  	},
  	name : 'indexCompany'
    },
    {
      path: '/create-company', component: CompanyCreate, name: 'createCompany'
    },
    {
      path: '/edit-company/:id', component: CompanyEdit, name: 'editCompany'
    },
    {
      path: '/a',
      components: {
      halamanIndex: HalamanIndex
    },
      name : 'indexHalaman'
    },
    {
      path: '/create-halaman', component: HalamanCreate, name: 'createHalaman'
    },
    {
      path: '/edit-halaman/:id', component: HalamanEdit, name: 'editHalaman'
    },
    {
      path: '/b',
      components: {
        menuIndex: MenuIndex
      },
      name : 'indexMenu'
    },
    {
      path: '/create-menu', component: MenuCreate, name: 'createMenu'
    },
    {
      path: '/edit-menu/:id', component: MenuEdit, name: 'editMenu'
    }
  ]

 const router = new VueRouter({ routes })

 const app = new Vue({ router }).$mount('#app')
