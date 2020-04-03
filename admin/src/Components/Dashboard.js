import React from 'react';
import { Title, Loading, useGetOne, usePermissions, Query, Error, ShowButton } from 'react-admin';

import { makeStyles } from '@material-ui/core/styles';
import Card from '@material-ui/core/Card';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';
import Grid from '@material-ui/core/Grid';
import BookingIcon from '@material-ui/icons/CalendarToday';
import BookingIconPending from '@material-ui/icons/HourglassEmpty';
import { Badge, List, ListItem, ListItemText, Link } from '@material-ui/core';


const useStyles = makeStyles({
  card: {
    minWidth: 275,
  },
  bullet: {
    display: 'inline-block',
    margin: '0 2px',
    transform: 'scale(0.8)',
  },
  title: {
    fontSize: 14,
  },
  pos: {
    marginBottom: 12,
  },
});


const preventDefault = () => {
  this.props.push("/bookings");
}


const payloadPending = {
   pagination: { page: 1, perPage: 10 },
   sort: { field: 'date', order: 'ASC' },
};

const payloadUpcoming = {
   pagination: { page: 1, perPage: 10 },
   sort: { field: 'date', order: 'ASC' },
};



const uglyDateFormatter = (date) => {
  let arr = date.split("+");
  arr = arr[0].split("T");
  const time = arr[1].slice(0,-3);
  arr = arr[0].split("-");
  const day = `${arr[2]}/${arr[1]}/${arr[0]}`;
  return `${day} à ${time}`;
}

const BookingList = ({payload, title, color, store, status}) => (
    <Query type='GET_LIST' resource='bookings' payload={{...payload, filter: { shop: store, status}}}>
        {({ data, total, loading, error }) => {
            if (loading) { return <Loading />; }
            if (error) { return <Error />; }
            return (
                <CardContent>
                    <Typography variant="h5" component="h2">
                      <Badge badgeContent={total} color={color}><BookingIcon /></Badge>   {title}
                    </Typography>
                    <Typography variant="body2" component="p">
                        <List>
                            {data.map(booking =>
                            <ListItem key={booking.quantity}>
                                <ShowButton resource="bookings" basePath="/bookings" record={booking} label={`Booking #${booking.id}`} icon={null} />
                                <ListItemText
                                  secondary={`${booking.firstname} ${booking.lastname}, ${uglyDateFormatter(booking.date)}`}>
                                </ListItemText>
                            </ListItem>
                            )}
                        </List>
                    </Typography>
                </CardContent>
            );
        }}
    </Query>
);

const UserProfile = ({ userId }) => (
    <Query type="GET_ONE" resource="users" payload={{ "id": userId }}>
        {({ data, loading, error }) => {
            if (loading) { return <Loading />; }
            if (error) { return <p>ERROR</p>; }
            return <UserInfos record={data}/>;
        }}
    </Query>
);

const UserInfos = ({ record }) => (
  <div>
    <div>Username : {record.username}</div>
    <div>Email : {record.email}</div>
    <div>Name : {record.firstname} {record.lastname}</div>
  </div>
);

const ShopProfile = ({ shopId }) => (
    <Query type="GET_ONE" resource="shops" payload={{ "id": shopId }}>
        {({ data, loading, error }) => {
            if (loading) { return <Loading />; }
            if (error) { return <p>ERROR</p>; }
            return <ShopInfos record={data}/>;
        }}
    </Query>
);

const ShopInfos = ({ record }) => (
  <div>
    <img style={{width: "250px"}} src={record.imageUrl}/>
    <div>Name : {record.name}</div>
    <div>Category : {record.category}</div>
    <div>Address : {record.streetAdress}, <br /> {record.postalCode } {record.city}</div>
  </div>
);

export default function Dashboard() {
  const { permissions } = usePermissions();
  let store, userId = null;
  if(permissions !== undefined) {
    store  = permissions.store;
    userId = permissions.userId;
  }
  const classes = useStyles();
  const bull = <span className={classes.bullet}>•</span>;
   return (
    <Grid container>
    <Title title="Foodcollect.fr" />
    { permissions !== undefined &&
      <>
      <Grid container xs={6} spacing={0}>
      <Grid xs={11} item>
        <Card className={classes.card}>
              <BookingList
                payload={payloadPending}
                store={store}
                title="Pending Bookings"
                color="error"
                status="pending"
              />
        </Card>
      </Grid>
      <Grid xs={11} item>
        <Card className={classes.card}>
              <BookingList
                payload={payloadUpcoming}
                store={store}
                title="Upcoming Bookings"
                color="primary"
                status="accepted"
              />
        </Card>
      </Grid>
    </Grid>
      <Grid container xs={6} spacing={3}>
      <Grid item xs={12} >
        <Card className={classes.card}>
          <CardContent>
            <Typography variant="h5" component="h2">
              Welcome to foodcollect !
            </Typography>
            <Typography className={classes.pos} color="textSecondary">
              Click & collect app
            </Typography>
            <Typography variant="body2" component="p">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur facilisis mattis ligula ultricies ultricies. Donec mollis est erat, a posuere neque pulvinar a. Cras eget varius mi, eu vulputate dolor. Aliquam erat volutpat. Aliquam non nibh quis risus laoreet rhoncus ac non eros. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec auctor libero et metus blandit luctus. Sed nec commodo nulla, et dapibus libero.
            </Typography>
          </CardContent>
        </Card>
        </Grid>
      <Grid xs={12} item >
      <Card className={classes.card}>
        <CardContent>
          <Typography variant="h5" component="h2">
            Your account
          </Typography>
          <UserProfile userId={userId} />
        </CardContent>
      </Card>
      </Grid>
      <Grid xs={12} item >
      <Card className={classes.card}>
        <CardContent>
          <Typography variant="h5" component="h2">
            Your shop
          </Typography>
          <ShopProfile shopId={store} />
        </CardContent>
      </Card>
      </Grid>
    </Grid>
    </>}
    </Grid>
    );
}


