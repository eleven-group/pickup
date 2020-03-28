import Vue from 'vue';
import Vuex from 'vuex';
import auth from '@/store/modules/auth';
import products from '@/store/modules/products';
import VuexPersist from 'vuex-persist';

Vue.use(Vuex);

const vueLocalStorage = new VuexPersist({
  key: 'storage',
  storage: window.localStorage,
  reducer: (state) => ({
    auth: {
      token: state.auth.token,
      user: state.auth.user
    }
  })
});

export default new Vuex.Store({
  modules: {
    auth,
    products
  },
  plugins: [vueLocalStorage.plugin]
});
