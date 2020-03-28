import axios from './config';

export default {
  getProducts () {
    return axios.get('/products');
  },
  getProduct (id) {
    return axios.get(`/products/${id}`);
  },
  putProduct (id, resource) {
    return axios.put(`/products/${id}`, { resource });
  },
  postProduct (resource) {
    return axios.put(`/products`, { resource });
  },
};
