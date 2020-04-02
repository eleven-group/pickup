import axios from 'axios';

import store from '@/store';

const DEFAULT_TIMEOUT = 50000;

const instance = axios.create({
  baseURL: process.env.VUE_APP_BACKEND_PROXY_URL,
  timeout: DEFAULT_TIMEOUT,
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  }
});

instance.interceptors.request.use(function (config) {
  const token = store.getters['auth/getToken'];
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
});

const osmApi = axios.create({
  baseURL: 'https://api.opencagedata.com/geocode/v1/json',
  timeout: DEFAULT_TIMEOUT
});

export default instance;

export { osmApi };
