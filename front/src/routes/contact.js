import Contact from '@/views/contact/Contact.vue';

const routes = [
  {
    path: '/contact',
    name: 'contact',
    component: Contact,
    meta: {
      auth: true
    }
  }
];

export default routes;
