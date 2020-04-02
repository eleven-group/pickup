import PaymentConfirmation from '@/views/payment/PaymentConfirmation.vue';
import RegisterConfirmation from '@/views/confirmation/Confirmation.vue';
import TokenConfirmation from '@/views/confirmation/TokenConfirmation.vue';

const routes = [
  {
    path: '/confirmation-payment',
    name: 'confirmation-payment',
    component: PaymentConfirmation,
    meta: {
      auth: true
    }
  },
  {
    path: '/confirmation-register',
    name: 'confirmation-register',
    component: RegisterConfirmation
  },
  {
    path: '/confirmation-token/:token',
    name: 'confirmation-token',
    component: TokenConfirmation
  }
];

export default routes;
