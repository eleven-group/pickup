import { fetchUtils } from 'react-admin';

export const settings = {
  headers: {
    'Accept': 'application/vnd.api+json',
    'Content-Type': 'application/vnd.api+json',
  }
};

export const httpClient = (url, options = {}) => {
    if (!options.headers) {
        options.headers = new Headers({ Accept: 'application/json' });
    }
    const token = localStorage.getItem('token');
    options.headers.set('Authorization', `Bearer ${token}`);
    return fetchUtils.fetchJson(url, options);
}
