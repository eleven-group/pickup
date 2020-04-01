import React from 'react';
import {
    List,
    Datagrid,
    TextField,
    BooleanField,
    EmailField,
    RichTextField,
    ImageField,
    TextInput,
    SimpleForm,
    Create,
    NumberInput,
    ReferenceInput,
    SelectInput
} from 'react-admin';

export const ProductList = ({permissions, ...props }) =>
{
let store = null;
if(permissions !== undefined) {
    store = permissions.store;
}
return (
    permissions !== undefined
    && <List {...props} filter={{ shop: store }}>
        <Datagrid>
            <TextField source="id" />
            <TextField source="name" />
            <TextField source="description" />
            <TextField source="price" />
            <TextField source="quantity" />
        </Datagrid>
    </List>
)};

export const ProductCreate = ({ permissions, ...props }) => (
    <Create {...props}>
        <SimpleForm >
            <TextInput label="The name of the product" source="name" />
            <TextInput label="The description of the product" source="description" />
            <NumberInput source="price" format={v => v/100} parse={v => Math.round(v*100)} label="Price" />
            <NumberInput source="quantity" label="Quantity" />
        </SimpleForm>
    </Create>
);

