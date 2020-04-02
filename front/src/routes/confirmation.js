import PaymentConfirmation from '@/views/payment/PaymentConfirmation.vue';

const routes = [
  {
    path: '/confirmation-payment',
    name: 'confirmation-payment',
    component: PaymentConfirmation,
    meta: {
      auth: true
    }
  }
];

export default routes;
