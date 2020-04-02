<template>
    <el-row justify="center" align="middle" type="flex" class="el-row loginContainer">
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <h2>Pickup</h2>
            <h4>Welcome !</h4>
          </div>
          <div>
            <el-form @submit.prevent.native=submitLogin>
              <label for="firstname">Firstname</label>
              <el-input id="firstname" ref="firstname" class="m-5" v-model="form.user.firstname"></el-input>
              <label for="lastname">Lastname</label>
              <el-input id="lastname" ref="lastname" class="m-5" v-model="form.user.lastname"></el-input>
              <label for="email">Email</label>
              <el-input id="email" ref="email" class="m-5" v-model="form.user.email"></el-input>
              <label for="password">Password</label>
              <el-input id="password" ref="password" class="m-5" v-model="form.user.password" show-password></el-input>
              <label for="passwordConfirmation">Password Confirmation</label>
              <el-input id="passwordConfirmation" ref="passwordConfirmation" class="m-5" v-model="form.user.passwordConfirmation" show-password></el-input>
              <br>
              <br>
              <label for="name">Name of your company</label>
              <el-input id="name" ref="name" class="m-5" v-model="form.shop.name"></el-input>
              <label for="description">Describe your company !</label>
              <el-input id="description" ref="description" class="m-5" v-model="form.shop.description"></el-input>
              <label for="streetAdress">Your shop adress</label>
              <el-input id="streetAdress" ref="streetAdress" class="m-5" v-model="form.shop.streetAdress"></el-input>
              <label for="postalCode">Your shop postal code</label>
              <el-input id="postalCode" ref="postalCode" class="m-5" v-model="form.shop.postalCode"></el-input>
              <label for="city">Your shop City</label>
              <el-input id="city" ref="city" class="m-5" v-model="form.shop.city"></el-input>
              <label for="time">Opening range</label>
              <br>
              <div v-for="(content, day) in form.shop.openingHours" :key="day">
                <label :for="day">{{day}}</label><br>
                <label :for="day">Morning</label>
                <el-time-picker
                  :id="`${day} morning
                  `"
                  :ref="`${day} morning
                  `"
                  format="HH:mm"
                  is-range
                  v-model="form.shop.openingHours[day].morning"
                  range-separator="To"
                  start-placeholder="Starting Time"
                  end-placeholder="Ending Time">
                </el-time-picker><br>
                <label :for="day">Afternoon</label>
                <el-time-picker
                  :id="`${day} afternoon`"
                  :ref="`${day} afternoon`"
                  is-range
                  format="HH:mm"
                  v-model="form.shop.openingHours[day].afternoon"
                  range-separator="To"
                  start-placeholder="Starting Time"
                  end-placeholder="Ending Time">
                </el-time-picker>
              </div><br>
              <label for="slo">Delivery range (time between each delivery)</label>
              <br>
              <el-time-select
                id="slotRange"
                ref="slotRange"
                  is-range
                placeholder="Time between each delivery"
                v-model="form.shop.slotRange"
                :picker-options="{
                  start: '00:00',
                  step: '00:05',
                  end: '01:00'
                }">
              </el-time-select>
              <br>
              <el-button native-type="submit" type="primary" :loading="loading">Register</el-button>
            </el-form>
          </div>
        </el-card>
    </el-row>
</template>

<script>
import userApi from '@/api/users';
import osmApi from '@/api/location';
import getSlotToMin from '@/helpers/getSlotToMin';

export default {
  name: 'Login',
  data () {
    return {
      form: {
        user: {
          firstname: '',
          lastname: '',
          email: '',
          password: '',
          passwordConfirmation: ''
        },
        shop: {
          name: '',
          description: '',
          streetAdress: '',
          postalCode: '',
          city: '',
          openingHours: {
            mon: { morning: '', afternoon: '' },
            tue: { morning: '', afternoon: '' },
            wed: { morning: '', afternoon: '' },
            thu: { morning: '', afternoon: '' },
            fri: { morning: '', afternoon: '' },
            sat: { morning: '', afternoon: '' },
            sunday: { morning: '', afternoon: '' }
          },
          slotRange: ''
        }
      },
      loading: false,
      error: false,
      isWeekEmpty: true,
      longitude: '',
      latitude: ''
    };
  },
  mounted () {
    this.$nextTick(() => this.$refs.firstname.focus());
  },
  methods: {
    async submitLogin () {
      const { form } = this;
      const { user, shop } = form;
      const { password, passwordConfirmation } = user;
      const { streetAdress, city, postalCode } = shop;

      Object.keys(user).forEach((item) => {
        if (!user[item] && !this.error) {
          this.$message({
            showClose: true,
            message: `Please enter your ${item}.`,
            type: 'error'
          });
          this.error = true;
          this.$refs[`${item}`].focus();
          this.loading = false;
        }
      });
      try {
        const geoRes = await osmApi.getGeocode(streetAdress, city, postalCode);
        this.longitude = geoRes.data.results[0].geometry.lng;
        this.latitude = geoRes.data.results[0].geometry.lat;
      } catch (e) {
        this.$message({
          showClose: true,
          message: "Oops, seems that your company adress can't be found, let's check your informations !",
          type: 'error'
        });
        this.loading = false;
        return;
      };
      Object.keys(shop).forEach(item => {
        if (item === 'openingHours') {
          Object.keys(shop[item]).forEach(day => {
            if (shop[item][day].morning || shop[item][day].afternoon) {
              if (shop[item][day].morning) {
                shop[item][day].morning[0] = shop[item][day].morning[0].toLocaleTimeString('fr', {
                  hour: '2-digit',
                  minute: '2-digit'
                });
                shop[item][day].morning[1] = shop[item][day].morning[1].toLocaleTimeString('fr', {
                  hour: '2-digit',
                  minute: '2-digit'
                });
                shop[item][day].morning = `${shop[item][day].morning[0]}-${shop[item][day].morning[1]}`;
              }
              if (shop[item][day].afternoon) {
                shop[item][day].afternoon[0] = shop[item][day].afternoon[0].toLocaleTimeString('fr', {
                  hour: '2-digit',
                  minute: '2-digit'
                });
                shop[item][day].afternoon[1] = shop[item][day].afternoon[1].toLocaleTimeString('fr', {
                  hour: '2-digit',
                  minute: '2-digit'
                });
                shop[item][day].afternoon = `${shop[item][day].afternoon[0]}-${this.form.shop[item][day].afternoon[1]}`;
              }
              this.isWeekEmpty = false;
            }
            const morning = shop[item][day].morning ? shop[item][day].morning : '';
            const afternoon = shop[item][day].afternoon ? shop[item][day].afternoon : '';
            shop[item][day] = [morning, afternoon];
          });
          return;
        }
        if (!shop[item] && !this.error) {
          this.$message({
            showClose: true,
            message: `Please enter your ${item}.`,
            type: 'error'
          });
          this.error = true;
          this.$refs[`${item}`].focus();
          this.loading = false;
        }
      });
      if (this.error) {
        this.error = false;
        return;
      }
      if (this.isWeekEmpty) {
        this.$message({
          showClose: true,
          message: `You need at least one day open`,
          type: 'error'
        });
        this.loading = false;

        return;
      }
      if (password !== passwordConfirmation) {
        this.$message({
          showClose: true,
          message: `Confirmation of your password should be identical to your password`,
          type: 'error'
        });

        this.$refs.passwordConfirmation.focus();
        this.loading = false;
        return;
      }
      if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(user.email))) {
        this.$message({
          showClose: true,
          message: `Your email has a wrong format (e.g. john@smith.usa)`,
          type: 'error'
        });
        this.$refs.email.focus();
        this.loading = false;

        return;
      }
      try {
        shop.slotRange = getSlotToMin(shop.slotRange);
        await userApi.registerUser(user, { ...shop, longitude: this.longitude.toString(), latitude: this.latitude.toString() });
        await this.$router.push({ path: '/confirmation' });
      } catch (error) {
        this.$message({
          showClose: true,
          message: 'Oops, something went wrong.',
          type: 'error'
        });
        this.loading = false;
      }
    }
  }
};
</script>
