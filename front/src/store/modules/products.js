import resourceApi from '@/api/products';

const state = {
  products: null,
  product: null
};

const getters = {
  getProduct: state => state.product,
  getProducts: state => state.products
};

const mutations = {
  setProducts (state, products) {
    state.products = products;
  },
  setProduct (state, product) {
    state.product = product;
  }
};

const actions = {
  async fetchProducts ({ commit }) {
    const { data: products } = await resourceApi.getProducts();
    commit('setProducts', products);
  },
  async fetchProduct ({ commit }, id) {
    const { data: product } = await resourceApi.getProduct(id);
    commit('setProduct', product);
  },
  async putProduct ({ commit }, id, resource) {
    const { data: res } = await resourceApi.putProduct(id, resource);
    commit('setProduct', res);
  },
  async postProduct ({ commit }, resource) {
    const { data: res } = await resourceApi.postProduct(resource);
    commit('setProduct', res);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
