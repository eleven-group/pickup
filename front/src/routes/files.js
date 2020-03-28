import Files from '@/views/files/Files.vue';

const routes = [
  {
    path: '/files',
    name: 'files',
    component: Files,
    meta: {
      auth: true
    }
  }
];

export default routes;
