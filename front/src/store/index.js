import Vue from 'vue';
import Vuex from 'vuex';
import auth from '@/store/modules/auth';
import products from '@/store/modules/products';
import location from '@/store/modules/location';
import shops from '@/store/modules/shops';
import cart from '@/store/modules/cart';
import VuexPersist from 'vuex-persist';

Vue.use(Vuex);

const vueLocalStorage = new VuexPersist({
  key: 'storage',
  storage: window.localStorage,
  reducer: (state) => ({
    auth: {
      token: state.auth.token,
      user: state.auth.user
    },
    location: {
      latitude: state.location.latitude,
      longitude: state.location.longitude
    },
    shops: {
      shops: state.shops.shops
    },
    cart: {
      cartCounter: state.cart.cartCounter,
      cartProducts: state.cart.cartProducts
    }
  })
});

export default new Vuex.Store({
  modules: {
    auth,
    products,
    location,
    shops,
    cart
  },
  plugins: [vueLocalStorage.plugin]
});
