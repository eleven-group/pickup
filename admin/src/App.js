import React from 'react';
import { Admin, Resource, ListGuesser } from 'react-admin';
import apiProvider from 'ra-iri-jsonapi-client';
import authProvider from './auth/authProvider';
import { UserList } from './Resources/users';
import { ShopList } from './Resources/shops';
import { ProductList } from './Resources/products';
import { settings, httpClient } from './api/config';

const BASE_URL = process.env.API_ENDPOINT;

const provider = apiProvider(BASE_URL, { ...httpClient, ... settings });

const App = () => (
    <Admin authProvider={authProvider} dataProvider={provider}>
        {permissions => [
          permissions === 'ROLE_ADMIN'
          ? <Resource name="users" list={UserList} />
          : null,
        ]}
        <Resource name="shops" list={ShopList} />
        <Resource name="products" list={ProductList} />
    </Admin>
);

export default App;
