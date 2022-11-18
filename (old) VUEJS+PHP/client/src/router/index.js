import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/Home.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/information',
      name: 'information',
      // route level code-splitting
      // this generates a separate chunk (information.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/Information.vue')
    },
    {
      path: '/contact',
      name: 'contact',
      component: () => import('../views/Apropos.vue')
    },
    {
      path: '/tournois',
      name: 'tournois',
      component: () => import('../views/Tournois.vue')
    },
  ]
})

export default router
