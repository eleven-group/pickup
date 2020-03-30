import Vue from 'vue';
import Router from 'vue-router';
import authApi from '@/api/auth';

import Home from '@/views/Home.vue';
import NotFound from '@/views/errors/NotFound.vue';

import LayoutDefault from '@/layouts/LayoutDefault.vue';
import LayoutModal from '@/layouts/LayoutModal.vue';

import usersRoutes from '@/routes/users';
import invoicesRoutes from '@/routes/invoices';
import filesRoutes from '@/routes/files';
import productsRoutes from '@/routes/products';

import store from '@/store';

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
        ...productsRoutes
      ]
    },
    {
      component: LayoutModal,
      path: ''
    },
    {
      path: '*',
      component: NotFound
    }
  ]
});

router.beforeEach(async (to, from, next) => {
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
});

export default router;
