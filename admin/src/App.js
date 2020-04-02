import React from 'react';
import { Admin, Resource, ListGuesser } from 'react-admin';
import authProvider from './auth/authProvider';
import { UserList } from './Resources/users';
import { ShopList } from './Resources/shops';
import { ProductList, ProductCreate, ProductEdit } from './Resources/products';
import customDataProvider from './api/config';


const App = () => (
    <Admin authProvider={authProvider} dataProvider={customDataProvider}>
    {permissions => [
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="users" list={UserList} />
      : null,
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="shops" list={ShopList} />
      : null,
        <Resource name="products" list={ProductList} create={ProductCreate} edit={ProductEdit} />,
    ]}
    </Admin>
);

export default App;
