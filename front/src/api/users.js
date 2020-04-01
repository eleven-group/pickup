import axios from './config';

export default {
  getUsers () {
    return axios.get('/users');
  },
  getUser () {
    return axios.get('/user');
  },
  registerUser ({
    firstname,
    lastname,
    email,
    password
  }) {
    const username = `${firstname}${lastname}${Math.floor(Math.random() * 10000)}`;
    return axios.post('/users', {
      username,
      firstname,
      lastname,
      email,
      password
    });
  }
};
