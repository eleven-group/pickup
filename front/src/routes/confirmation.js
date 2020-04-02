import Confirmation from '@/views/payment/PaymentConfirmation.vue';

const routes = [
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
