import { fetchUtils } from 'react-admin';
import apiProvider from 'ra-iri-jsonapi-client';

const settings = {
  headers: {
    'Accept': 'application/vnd.api+json',
    'Content-Type': 'application/vnd.api+json',
  }
};

const httpClient = (url, options = {}) => {
    if (!options.headers) {
        options.headers = new Headers({ Accept: 'application/json' });
    }
    const token = localStorage.getItem('token');
    options.headers.set('Authorization', `Bearer ${token}`);
    return fetchUtils.fetchJson(url, options);
}

const API_ENDPOINT = process.env.REACT_APP_API_ENDPOINT;

const provider = apiProvider(API_ENDPOINT, { ...httpClient, ...settings });

export default provider;
