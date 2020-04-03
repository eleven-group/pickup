import React, { useCallback } from 'react';
import {
    List,
    Datagrid,
    TextField,
    TextInput,
    SimpleForm,
    SelectInput,
    FunctionField,
    Edit,
    DateField,
    SelectField,
    Filter,
    SimpleShowLayout,
    Show,
    ReferenceManyField,
    ChipField,
    SaveButton,
    Toolbar,
    useCreate,
    useRedirect,
    useNotify,
} from 'react-admin';
import { useForm } from 'react-final-form';
import CustomizableDatagrid from 'ra-customizable-datagrid';
import { statusBooking } from '../data';
import { Typography } from '@material-ui/core';

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
    && <List {...props}
        filter={{ shop: store }}
        filters={<PostFilter/>}
        filterDefaultValues={{ status: 'pending' }}
        sort={{ field: 'date', order: 'ASC' }}
        >
        <CustomizableDatagrid rowClick="show">
            <TextField source="id" label="Numéro de commande" />
            <DateField source="date" locales="fr-FR" showTime/>
            <FunctionField label="Nom du client" render={record => `${record.firstname} ${record.lastname}`} />
            <SelectField source="status" choices={statusBooking} />
        </CustomizableDatagrid>
    </List>
)};

export const BookingShow = (props) => (
    <Show  {...props}>
      <SimpleShowLayout>
        <TextField source="id" />
        <SelectField source="status" choices={statusBooking} />
        <DateField source="date"  locales="fr-FR" showTime/>
        <FunctionField label="Nom du client" render={record => `${record.firstname} ${record.lastname}`} />
        <TextField source="phonenumber" label="Phone number" />
        <TextField source="email" label="Email" />
        <ReferenceManyField label="Produits commandés" reference="booking-items" target="booking" source="id" >
            <Datagrid>
                <TextField label="Numéro produit" source="relationships.product.id" />
                <TextField label="Nom du produit" source="relationships.product.name" />
                <ChipField source="quantity" label="Quantité" />>
            </Datagrid>
        </ReferenceManyField>
      </SimpleShowLayout>
    </Show>
);

export const BookingEdit = (props) => (
    <Edit title="Modify a Booking" {...props}>
        <SimpleForm toolbar={<PostCreateToolbar />} redirect="show">
            <TextInput disabled label="Id" source="id" />
            <TextInput disabled source="status" label="Status of the booking" choices={statusBooking} />
            <DateField disabled source="date" label="Date of the collect" locales="fr-FR" showTime/>
        </SimpleForm>
    </Edit>
);

const PostCreateToolbar = props => (
    <Toolbar {...props} >
        <StatusChange
            label="Pass the booking to DONE"
            redirect="show"
            submitOnEnter={false}
            status="done"
        />
        <StatusChange
            label="Pass the booking to CANCELED"
            redirect="show"
            submitOnEnter={false}
            variant="text"
            status="canceled"
        />
    </Toolbar>
);

const StatusChange = ({ handleSubmitWithRedirect, ...props }) => {


    const [create] = useCreate('bookings');
    const redirectTo = useRedirect();
    const notify = useNotify();
    const { basePath, redirect, status } = props;

    const form = useForm();

    const handleClick = useCallback(() => {

        form.change('status', status);

        handleSubmitWithRedirect('edit');
    }, [form]);

    return <SaveButton {...props} handleSubmitWithRedirect={handleClick} />;
};
