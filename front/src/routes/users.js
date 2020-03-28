import Profile from '@/views/users/Profile.vue';

const routes = [
  {
    path: '/profile',
    name: 'users.profile',
    component: Profile,
    meta: {
      auth: true
    }
  }
];

export default routes;
