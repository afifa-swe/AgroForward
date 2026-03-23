import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(),
  scrollBehavior: () => ({ top: 0, behavior: 'smooth' }),
  routes: [
    {
      path: '/',
      component: () => import('@/pages/HomePage.vue'),
      meta: { transition: 'page' },
    },
    {
      path: '/about',
      component: () => import('@/pages/AboutPage.vue'),
      meta: { transition: 'page' },
    },
    {
      path: '/investors',
      component: () => import('@/pages/InvestorsPage.vue'),
      meta: { transition: 'page' },
    },
    {
      path: '/contacts',
      component: () => import('@/pages/ContactsPage.vue'),
      meta: { transition: 'page' },
    },
  ],
})

router.afterEach(() => {
  window.scrollTo({ top: 0, behavior: 'smooth' })
})

export default router
