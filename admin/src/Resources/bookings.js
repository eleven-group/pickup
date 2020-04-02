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
    Edit,
    DateField,
    SelectField,
    Filter,
    SimpleShowLayout,
    EditButton,
    DeleteButton,
    Show,
    ReferenceManyField,
    SingleFieldList,
    ChipField,
} from 'react-admin';
import CustomizableDatagrid from 'ra-customizable-datagrid';
import { statusBooking } from '../data';


const PostFilter = (props) => (
    <Filter {...props}>
        <SelectInput label="Status" source="status" defaultValue="pending" choices={statusBooking}/>
        <TextInput label="Lastname" source="lastname"/>
    </Filter>
);

export const BookingList = ({permissions, ...props }) =>
{
let store = null;
if(permissions !== undefined) {
    store = permissions.store;
}
return (
    permissions !== undefined
    && <List {...props} filter={{ shop: store }} filters={<PostFilter/>} sort={{ field: 'date', order: 'ASC' }}>
        <CustomizableDatagrid rowClick="show">
            <TextField source="id" label="Order ID" />
            <DateField source="date" label="Date of the collect" locales="fr-FR" showTime/>
            <FunctionField label="Name of the customer" render={record => `${record.firstname} ${record.lastname}`} />
            <SelectField source="status" choices={statusBooking} />
        </CustomizableDatagrid>
    </List>
)};

export const BookingShow = (props) => (
    <Show {...props}>
      <SimpleShowLayout>
        <TextField label="Booking ID" source="id" />
        <SelectField source="status" label="Status of the booking" choices={statusBooking} />
        <DateField source="date" label="Date of the collect" locales="fr-FR" showTime/>
        <FunctionField label="Name of the customer" render={record => `${record.firstname} ${record.lastname}`} />
        <TextField source="phonenumber" label="Phone number" />
        <TextField source="email" label="Email" />
        <ReferenceManyField label="Order items in the order" reference="booking-items" target="booking" source="id" >
            <Datagrid>
                <TextField label="Product ID" source="relationships.product.id" />
                <TextField label="Product name" source="relationships.product.name" />
                <ChipField label="Quantity" source="quantity" />>
            </Datagrid>
        </ReferenceManyField>
        <EditButton />
      </SimpleShowLayout>
    </Show>
);
