import React from 'react';
import { Admin, Resource, ListGuesser } from 'react-admin';
import apiProvider from 'ra-iri-jsonapi-client';
import authProvider from './auth/authProvider';
import { UserList } from './Resources/users';
import { ShopList } from './Resources/shops';
import { ProductList, ProductCreate } from './Resources/products';
import { settings, httpClient } from './api/config';

const API_ENDPOINT = process.env.REACT_APP_API_ENDPOINT;

const provider = apiProvider(API_ENDPOINT, { ...httpClient, ... settings });

const App = () => (
    <Admin authProvider={authProvider} dataProvider={provider}>
    {permissions => [
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="users" list={UserList} />
      : null,
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="shops" list={ShopList} />
      : null,
        <Resource name="products" list={ProductList} create={ProductCreate} />,
    ]}
    </Admin>
);

export default App;
