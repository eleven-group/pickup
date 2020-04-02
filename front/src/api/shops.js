import axios from './config';

export default {
  getShops () {
    return axios.get('/shops');
  },
  getSlots (id, page) {
    return axios.get(`/shops/${id}/slots`);
  }
};
