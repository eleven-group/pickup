import axios from './config';

export default {
  postBooking (payload) {
    return axios.post('/bookings', payload);
  },
};
