import Order from '@/views/order/Order.vue';
import RegisterConfirmation from '@/views/confirmation/Confirmation.vue';
import TokenConfirmation from '@/views/confirmation/TokenConfirmation.vue';
import BookingConfirmation from '@/views/confirmation/BookingConfirmation.vue';
import BookingTokenConfirmation from '@/views/confirmation/BookingTokenConfirmation.vue';
import BookingTokenCancelation from '@/views/confirmation/BookingTokenCancelation.vue';

const routes = [
  {
    path: '/order',
    name: 'order',
    component: Order,
    meta: {
      auth: true
    }
  },
  {
    path: '/confirmation-register',
    name: 'confirmation-register',
    component: RegisterConfirmation
  }, {
    path: '/confirmation-token/:token',
    name: 'confirmation-token',
    component: TokenConfirmation
  }, {
    path: '/confirmation-booking',
    name: 'confirmation-booking',
    component: BookingConfirmation
  }, {
    path: '/confirmation-new-booking',
    name: 'confirmation-new-booking',
    component: BookingTokenConfirmation
  }, {
    path: '/cancel-booking',
    name: 'cancel-booking',
    component: BookingTokenCancelation
  }
];

export default routes;
