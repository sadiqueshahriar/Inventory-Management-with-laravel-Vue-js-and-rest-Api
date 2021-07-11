require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

//vuelidate import
// import Vuelidate from 'vuelidate';
// Vue.use(Vuelidate)
// window.Vuelidate=Vuelidate

//import user class
import User from './helper/User';
window.User=User

//import Notification class
import Notification from './helper/Notification';
window.Notification=Notification

//sweet alert start
import Swal from 'sweetalert2'
window.Swal=Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});
window.Toast=Toast;

//sweet alert end
window.Reload=new Vue();

//import router
import {routes } from './routes';

const router = new VueRouter({
  routes,
  mode:'history'
})

const app = new Vue({
    el: '#app',
    router
});
