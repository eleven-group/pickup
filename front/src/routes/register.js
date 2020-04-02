import Register from '@/views/Register.vue';
import Confirmation from '@/views/Confirmation.vue';

const routes = [
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: true
    }
  },
  {
    path: '/confirmation',
    name: 'confirmation',
    component: Confirmation,
    meta: {
      auth: true
    }
  }
];

export default routes;
