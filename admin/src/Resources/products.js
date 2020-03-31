import React from 'react';
import {
    List,
    Datagrid,
    TextField,
    BooleanField,
    EmailField,
    RichTextField,
    ImageField,

} from 'react-admin';

export const ProductList = (props) => (
    <List {...props} filter={{ owner: localStorage.getItem('userId') }}>
        <Datagrid>
            <TextField source="id" />
            <TextField source="username" />
            <EmailField source="email" />
            <BooleanField source="isActive" />
            <ImageField source="avatar" title="avatar"/>
            <RichTextField source="bio" />
        </Datagrid>
    </List>
);
