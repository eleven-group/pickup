import _ from 'lodash';

const state = {
  cartCounter: 0,
  cartProducts: []
};

const getters = {
  getCartCounter: state => state.cartCounter,
  getCartProducts: state => state.cartProducts
};

const mutations = {
  addCartProduct (state, product) {
    state.cartProducts.push(product);
    state.cartCounter += 1;
  },
  deleteOne(state, product) {
    if (state.product.quantity > 1) {
      state
    }
    state.cartProducts.push(product);
    state.cartCounter += 1;
  },
  deleteCartProduct (state, productId) {
    _.remove(state.cartProducts, product => (productId === product.id));
    state.cartCounter -= 1;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations
};
