import Vue from 'vue'
import Router from 'vue-router'
import Desenvolvedor from '@/pages/Desenvolvedor/Desenvolvedor'
import ConfigDesenvolvedor from '@/pages/Desenvolvedor/ConfigDesenvolvedor'

Vue.use(Router);


export default new Router({
  routes: [ 
    {
      path: '/',
      name: 'Desenvolvedor',
      component: Desenvolvedor
    },
    {
      path: '/ConfigDesenvolvedor/:id',
      name: 'ConfigDesenvolvedor',
      component: ConfigDesenvolvedor
    }
  ]
})
