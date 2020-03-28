import store from '@/store';
import Login from '@/views/Login.vue';

const routes = [
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  {
    path: '/logout',
    name: 'logout',
    meta: {
      auth: false
    },
    beforeEnter: async (to, from, next) => {
      await store.dispatch('auth/logout');
      next('/login');
    }
  }];

export default routes;
