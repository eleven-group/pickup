import resourceApi from '@/api/shops';

const state = {
  shops: []
};

const getters = {
  getShops: state => state.shops
};

const mutations = {
  setShops (state, shops) {
    state.shops = shops;
  }
};

const actions = {
  async fetchShops ({ commit }) {
    const { data: shops } = await resourceApi.getShops();
    commit('setShops', shops);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
