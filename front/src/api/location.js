import { osmApi } from './config';

const token = process.env.VUE_APP_MAP_TOKEN;

export default {
  getGeocode (street, city, postalcode) {
    return osmApi.get('/search', {
      params: {
        q: `${street} ${city} ${postalcode}`,
        key: token
      } });
  }
};
