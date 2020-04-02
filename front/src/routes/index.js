import Vue from 'vue';
import Router from 'vue-router';

import Home from '@/views/Home.vue';

import LayoutDefault from '@/layouts/LayoutDefault.vue';
import LayoutModal from '@/layouts/LayoutModal.vue';
import LayoutError from '@/layouts/LayoutError.vue';

import usersRoutes from '@/routes/users';
import invoicesRoutes from '@/routes/invoices';
import filesRoutes from '@/routes/files';
import productsRoutes from '@/routes/products';
import contactRoutes from '@/routes/contact';
import confirmationRoutes from '@/routes/confirmation';
import aboutRoutes from '@/routes/about';
import registerRoutes from '@/routes/register';

Vue.use(Router);

export const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      component: LayoutDefault,
      path: '',
      children: [
        {
          path: '/',
          name: 'home',
          component: Home
        },
        ...usersRoutes,
        ...invoicesRoutes,
        ...filesRoutes,
        ...productsRoutes,
        ...contactRoutes,
        ...confirmationRoutes,
        ...aboutRoutes,
        ...registerRoutes
      ]
    },
    {
      component: LayoutModal,
      path: ''
    },
    {
      component: LayoutError,
      path: '*'
    }
  ]
});

/* router.beforeEach(async (to, from, next) => {
  if (to.matched.some(record => record.meta.auth)) {
    try {
      const response = await authApi.getUserInfo();
      const user = response.data;
      if (!user || !user.isActive) {
        await store.dispatch('auth/logout');
        return next('/login');
      }
      await store.commit('auth/setUser', user);
      return next();
    } catch (error) {
      if (error.response.data.code === 401) {
        await store.dispatch('auth/logout');
        return next('/login');
      }
    }
  } else {
    return next();
  }
}); */

export default router;
