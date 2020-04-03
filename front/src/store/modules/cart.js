import _ from 'lodash';

const state = {
  cartCounter: 0,
  cartProducts: [],
  cartShop: {},
  cartError: ''
};

const getters = {
  getCartCounter: state => state.cartCounter,
  getCartProducts: state => state.cartProducts,
  getCartShop: state => state.cartShop,
  getCartError: state => state.cartError
};

const mutations = {
  setCardShop (state, shop) {
    state.shop = shop;
  },
  addCartProduct (state, product) {
    if (state.cartProducts.length === 0 || (state.cartShop.id && state.cartShop.id === product.shop.id)) {
      state.cartShop = product.shop;
      const theProduct = _.find(state.cartProducts, productFromState => (productFromState.id === product.id));
      if (theProduct) {
        theProduct.ordered += product.ordered;
        state.cartError = '';
        return;
      }
      state.cartProducts.push(product);
      state.cartCounter += 1;
      state.cartError = '';
      return;
    }
    state.cartError = "Vous ne pouvez pas ajouter un produit d'un autre magasin à une commande déjà en cours";
  },
  deleteCartProduct (state, productId) {
    _.remove(state.cartProducts, product => (productId === product.id));
    state.cartCounter -= 1;
  },
  deleteOne (state, productIndex) {
    if (state.cartProducts[productIndex].ordered <= 1) {
      _.remove(state.cartProducts, product => (state.cartProducts[productIndex].id === product.id));
      state.cartCounter -= 1;
      return;
    }
    state.cartProducts[productIndex].ordered -= 1;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations
};
