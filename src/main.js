
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

var store = {
  state:{
    usuario:"",
    aviso:""
  },
  getters:{
    getAviso:state =>{
      return state.aviso;
    },
    getUsuario:state => {
      return state.usuario;
    }
  },
  mutations:{
    setUsuario(state,param){
      state.usuario = param; 
    },
    setAviso(state,param){
      state.aviso = param; 
    }
  }
}

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(ToastPlugin)
//teste
Vue.config.productionTip = false
Vue.prototype.$http = axios;
// Vue.prototype.$url = "http://localhost/preventiva_git 09-08/ws/api2.php";

new Vue({
  el: '#app',
  store: new Vuex.Store(store),
  router,
  components: { App },
  template: '<App/>'
})
