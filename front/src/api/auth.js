import axios from './config';

export default {
  getToken (username, password) {
    return axios.post('/login_check', { username, password });
  },
  getUserInfo () {
    return axios.get('/users/me');
  }
};
