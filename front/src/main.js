import Vue from 'vue';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/reset.css';
import 'element-ui/lib/theme-chalk/index.css';
import 'vue-material-design-icons/styles.css';
import router from '@/routes';
import store from '@/store';
import App from '@/App.vue';

Vue.use(ElementUI);
Vue.config.productionTip = process.env.NODE_ENV !== 'production';

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
