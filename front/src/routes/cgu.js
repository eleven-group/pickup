import InProgress from '@/views/inprogress/InProgress.vue';

const routes = [
  {
    path: '/cgu',
    name: 'cgu',
    component: InProgress,
    meta: {
      auth: false
    }
  }
];

export default routes;
