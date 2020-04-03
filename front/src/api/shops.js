import axios from './config';

export default {
  getShops () {
    return axios.get('/shops?pagination=false');
  },
  getSlots (id, page) {
    return axios.get(`/shops/${id}/slots`);
  }
};
