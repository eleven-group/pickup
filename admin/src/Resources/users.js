import React from 'react';
import {
    List,
    Datagrid,
    TextField,
    BooleanField,
    EmailField,
    RichTextField,
    ImageField,
    ReferenceField,
    TextInput,
    Filter

} from 'react-admin';


export const UserList = ({ role, userId, ...props}) => (
    <List { ...props}>
        <Datagrid>
            <TextField source="id" />
            <TextField source="username" />
            <EmailField source="email" />
            <BooleanField source="isActive" />
            <ImageField source="avatar" title="avatar"/>
            <RichTextField source="bio" />
            <ReferenceField label="Shop" reference="shops" source="relationships.shop.id">
                <TextField source="name" />
            </ReferenceField>
        </Datagrid>
    </List>
);
