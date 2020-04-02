import About from '@/views/about/About.vue';

const routes = [
  {
    path: '/about',
    name: 'about',
    component: About,
    meta: {
      auth: false
    }
  }
];

export default routes;
