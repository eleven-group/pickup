import Invoices from '@/views/invoices/Invoices.vue';

const routes = [
  {
    path: '/invoices',
    name: 'invoices',
    component: Invoices,
    meta: {
      auth: true
    }
  }
];

export default routes;
