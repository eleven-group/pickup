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

} from 'react-admin';
import { statusAbsence, typeAbsence } from '../data';

export const AbsenceList = (props) => (
    <List {...props}>
        <Datagrid>
            <TextField source="id" />
            <SelectField choices={statusAbsence} source="status" />
            <SelectField choices={typeAbsence} source="type" />
            <DateField label="From" source="startAt" showTime/>
            <DateField label="To" source="endAt" showTime/>
        </Datagrid>
    </List>
);
