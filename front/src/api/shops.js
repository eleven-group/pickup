import axios from './config';

export default {
  getShops () {
    return axios.get('/shops');
  }
};
