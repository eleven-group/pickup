import Products from '@/views/products/Products.vue';

const routes = [
  {
    path: '/products/:index',
    name: 'products',
    component: Products,
    meta: {
      auth: true
    }
  }
];

export default routes;
