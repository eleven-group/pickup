import React from 'react';
import {
    List,
    Datagrid,
    TextField,
    BooleanField,
    EmailField,
    RichTextField,
    ImageField,
    DateField,
    SelectField,
    ReferenceField,

} from 'react-admin';
import { statusAbsence, typeAbsence } from '../data';

export const ShopList = (props) => (
    <List {...props}>
        <Datagrid>
            <TextField source="id" />
            <TextField source="name" />
            <TextField source="streetAdress" />
            <TextField source="city" />
            <TextField source="postalCode" />
            <ReferenceField label="Owner" reference="users" source="relationships.owner.id">
                <TextField source="email" />
            </ReferenceField>
            <BooleanField source="isActive" />
        </Datagrid>
    </List>
);
