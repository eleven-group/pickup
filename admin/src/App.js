import React from 'react';
import { Admin, Resource, ListGuesser } from 'react-admin';
import apiProvider from 'ra-iri-jsonapi-client';
import authProvider from './auth/authProvider';
import { UserList } from './Resources/users';
import { AbsenceList } from './Resources/absences';
import { InvoiceList } from './Resources/invoices';
import { settings, httpClient } from './api/config';


const provider = apiProvider('http://api.pickup.localhost/api', { ...httpClient, ... settings });

const App = () => (
    <Admin authProvider={authProvider} dataProvider={provider}>
        <Resource name="users" list={UserList} />
        <Resource name="invoices" list={InvoiceList} />
        <Resource name="absences" list={AbsenceList} />
    </Admin>
);

export default App;
