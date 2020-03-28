import authApi from '@/api/auth';

const state = {
  user: null,
  token: null
};

const getters = {
  getUser: state => state.user,
  getToken: state => state.token
};

const mutations = {
  setToken (state, token) {
    state.token = token;
  },
  setUser (state, user) {
    state.user = user;
  }
};

const actions = {
  async login ({ commit }, { username, password }) {
    const res = await authApi.getToken(username, password);
    const { token } = res.data;
    commit('setToken', token);
  },
  async fetchUserInfo ({ commit }) {
    const { data: user } = await authApi.getUserInfo();
    commit('setUser', user);
  },
  logout ({ commit }) {
    commit('setUser', null);
    commit('setToken', null);
  }
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations
};
