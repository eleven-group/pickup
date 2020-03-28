import Products from '@/views/products/Products.vue';
import ProductShow from '@/views/products/ProductShow.vue';
const routes = [
  {
    path: '/products/:id',
    name: 'products.show',
    component: ProductShow,
    meta: {
      auth: true
    }
  },
  {
    path: '/products',
    name: 'products',
    component: Products,
    meta: {
      auth: true
    }
  },
];

export default routes;
