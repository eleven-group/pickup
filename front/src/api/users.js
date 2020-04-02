import axios from './config';

export default {
  getUsers () {
    return axios.get('/users');
  },
  getUser () {
    return axios.get('/user');
  },
  registerUser (user, shop) {
    const { firstname, lastname, email, password } = user;
    const username = `${firstname}${lastname}${Math.floor(Math.random() * 10000)}`;
    return axios.post('/shops',
      {
        ...shop,
        owner: {
          username,
          firstname,
          lastname,
          email,
          password
        },
        isActive: false
      });
  }
};
