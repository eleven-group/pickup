import React from 'react';
import {
    List,
    Datagrid,
    TextField,
    BooleanField,
    EmailField,
    RichTextField,
    TextInput,
    SimpleForm,
    Create,
    NumberInput,
    ReferenceInput,
    SelectInput,
    ImageInput,
    ImageField,
    NumberField,
    FunctionField,
    Edit
} from 'react-admin';
import CustomizableDatagrid from 'ra-customizable-datagrid';


export const ProductList = ({permissions, ...props }) =>
{
let store = null;
if(permissions !== undefined) {
    store = permissions.store;
}
return (
    permissions !== undefined
    && <List {...props} filter={{ shop: store }}>
        <CustomizableDatagrid rowClick="show">
            <TextField source="id" />
            <ImageField source="image" />
            <TextField source="name" />
            <TextField source="description" />
            <FunctionField label="Price" render={record => `€${record.price/100}`} />
            <NumberField source="quantity" />
        </CustomizableDatagrid>
    </List>
)};

export const ProductCreate = ({ permissions, ...props }) => (
    <Create {...props}>
        <SimpleForm >
            <TextInput  source="name" />
            <TextInput source="description" />
            <NumberInput source="price" format={v => v/100} parse={v => Math.round(v*100)} label="Price" />
            <NumberInput source="quantity" />
        </SimpleForm>
    </Create>
);

export const ProductEdit = (props) => (
    <Edit {...props}>
        <SimpleForm>
            <TextInput source="name" />
            <TextInput source="description" />
            <NumberInput source="price" format={v => v/100} parse={v => Math.round(v*100)} label="Price" />
            <NumberInput source="quantity" />
        </SimpleForm>
    </Edit>
);
