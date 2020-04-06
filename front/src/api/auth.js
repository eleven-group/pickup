import axios from './config';

export default {
  getToken (username, password) {
    return axios.post('/login_check', { username, password });
  },
  getUserInfo () {
    return axios.get('/users/me');
  },
  getConfirmation (token) {
    return axios.get(`/token-validation?token=${token}`);
  },
  getConfirmationBooking (token) {
    return axios.get(`/order-confirmation?token=${token}`);
  },
  getCanceledBooking (token) {
    return axios.get(`/order-cancelation?token=${token}`);
  }
};
