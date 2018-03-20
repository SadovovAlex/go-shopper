import Vue from 'vue'
import Router from 'vue-router'
import Dashboard from 'views/Dashboard'
import Post from 'views/Post'
import About from 'views/About'
import Items from 'views/Items'
import ItemsAdd from 'views/Items/Add'

Vue.use(Router)

export const routes = [
  {
    path: '/',
    component: Dashboard,
    meta: {
      title: 'Покупки'
    }
  },
  {
    path: '/items',
    component: Items,
    meta: {
      title: 'Покупка'
    }
  },
  {
    path: '/items/add',
    component: ItemsAdd,
    meta: {
      title: 'Добавить товар'
    }
  },

  {
    path: '/post/:id',
    component: Post,
    meta: {
      title: 'яяяяя'
    }
  }, {
    path: '/about',
    component: About,
    meta: {
      title: 'About'
    }
  }
]
export const router = new Router({ mode: 'history', routes })
