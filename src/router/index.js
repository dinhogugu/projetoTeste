import Vue from 'vue'
import Router from 'vue-router'
import Desenvolvedor from '@/pages/Desenvolvedor/Desenvolvedor'
import CadastroDesenvolvedor from '@/pages/Desenvolvedor/CadastroDesenvolvedor'

Vue.use(Router);


export default new Router({
  routes: [ 
    {
      path: '/',
      name: 'Desenvolvedor',
      component: Desenvolvedor
    },
    {
      path: '/cadastro_desenvolvedor/:id',
      name: 'CadastroDesenvolvedor',
      component: CadastroDesenvolvedor
    }
  ]
})
