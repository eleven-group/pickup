import Register from '@/views/Register.vue';

const routes = [
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: true
    }
  }
];

export default routes;
