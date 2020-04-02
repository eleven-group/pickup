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
            <ImageField source="image" title="title" />
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
            <TextInput label="The name of the product" source="name" />
            <TextInput label="The description of the product" source="description" />
            <NumberInput source="price" step="false" format={v => v/100} parse={v => Math.round(v*100)} label="Price" />
            <NumberInput source="quantity" label="Quantity" />
            <TextInput label="Image url of the product (optionnal)" source="imageUrl" />
        </SimpleForm>
    </Create>
);

export const ProductEdit = (props) => (
    <Edit {...props}>
        <SimpleForm>
            <TextInput label="The name of the product" source="name" />
            <TextInput label="The description of the product" source="description" />
            <NumberInput source="price" step="false" format={v => v/100} parse={v => Math.round(v*100)} label="Price" />
            <NumberInput source="quantity" label="Quantity" />
            <TextInput label="Image url of the product (optionnal)" source="imageUrl" />
        </SimpleForm>
    </Edit>
);
