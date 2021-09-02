
import Vue from 'vue'
import App from './App'
import router from './router'
import { BootstrapVue, IconsPlugin,ToastPlugin } from 'bootstrap-vue'
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vuex from 'vuex';
import VueMask from "v-mask";

Vue.use(VueMask);
Vue.use(Vuex);

// var store = {
//   state:{
//     aviso:""
//   },
//   getters:{
//     getAviso:state =>{
//       return state.aviso;
//     },
//   },
//   mutations:{
//     setAviso(state,param){
//       state.aviso = param; 
//     }
//   }
// }

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(ToastPlugin)

Vue.prototype.$http = axios;
Vue.prototype.$url = "http://127.0.0.1:8000/api";

new Vue({
  el: '#app',
  // store: new Vuex.Store(store),
  router,
  components: { App },
  template: '<App/>'
})
