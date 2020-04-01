import { osmApi } from './config';

export default {
  getGeocode (street, city, postalcode) {
    return osmApi.get('/search', {
      params: {
        street,
        city,
        postalcode,
        format: 'geocodejson'
      } });
  }
};
