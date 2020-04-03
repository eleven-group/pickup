import React from 'react';
import { Admin, Resource, ListGuesser } from 'react-admin';
import authProvider from './auth/authProvider';

import { UserList } from './Resources/users';
import { ShopList } from './Resources/shops';
import { ProductList, ProductCreate, ProductEdit } from './Resources/products';
import { BookingList, BookingShow, BookingEdit } from './Resources/bookings';

import customDataProvider from './api/config';
import PostIcon from '@material-ui/icons/Book';
import UserIcon from '@material-ui/icons/People';
import ProductIcon from '@material-ui/icons/LocalOffer';
import BookingIcon from '@material-ui/icons/CalendarToday';


import LoginView from './Components/LoginView';
import Dashboard from './Components/Dashboard';
import MyLayout from './Components/MyLayout';


import { createMuiTheme } from '@material-ui/core/styles';
import indigo from '@material-ui/core/colors/indigo';
import blue from '@material-ui/core/colors/blue';
import red from '@material-ui/core/colors/red';



const theme = createMuiTheme({
  palette: {
    primary: blue,
    secondary: indigo,
    error: red,
    contrastThreshold: 3,
    tonalOffset: 0.2,
    type: 'dark', // Switching the dark mode on is a single property value change.
  },
});


const App = () => (
    <Admin layout={MyLayout} theme={theme} dashboard={Dashboard} authProvider={authProvider} dataProvider={customDataProvider}>
    {permissions => [
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="users" list={UserList} icon={UserIcon}/>
      : null,
      permissions.role === 'ROLE_ADMIN'
      ? <Resource name="shops" list={ShopList} />
      : null,

        <Resource
          name="products"
          icon={ProductIcon}
          options={{ label: 'My Products' }}
          list={ProductList}
          create={ProductCreate}
          edit={ProductEdit}
        />,

        <Resource name="bookings"
          options={{ label: 'My Bookings' }}
          icon={BookingIcon}
          list={BookingList}
          show={BookingShow}
          edit={BookingEdit}
        />,

        <Resource name="booking-items"/>,
    ]}
    </Admin>
);

export default App;
