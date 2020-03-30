const state = {
  latitude: '48.847360032023104',
  longitude: '2.393603324890137'
};

const getters = {
  getLatitude: state => state.latitude,
  getLongitude: state => state.longitude
};

const mutations = {
  setLatitude (state, latitude) {
    state.latitude = latitude;
  },
  setLongitude (state, longitude) {
    state.longitude = longitude;
  }
};

export default {
  namespaced: true,
  state,
  getters,
  mutations
};
