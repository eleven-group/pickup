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
              <el-input id="firstname" ref="firstname" class="m-5" v-model="form.firstname"></el-input>
              <label for="lastname">Lastname</label>
              <el-input id="lastname" ref="lastname" class="m-5" v-model="form.lastname"></el-input>
              <label for="email">Email</label>
              <el-input id="email" ref="email" class="m-5" v-model="form.email"></el-input>
              <label for="password">Password</label>
              <el-input id="password" ref="password" class="m-5" v-model="form.password" show-password></el-input>
              <label for="passwordConfirmation">Password Confirmation</label>
              <el-input id="passwordConfirmation" ref="passwordConfirmation" class="m-5" v-model="form.passwordConfirmation" show-password></el-input>
              <el-button native-type="submit" type="primary" :loading="loading">Register</el-button>
            </el-form>
          </div>
        </el-card>
    </el-row>
</template>

<script>
import { mapActions } from 'vuex';
import _ from '../api/users';

export default {
  name: 'Login',
  data () {
    return {
      form: {
        firstname: '',
        lastname: '',
        email: '',
        password: '',
        passwordConfirmation: ''
      },
      loading: false,
      error: false
    };
  },
  mounted () {
    this.$nextTick(() => this.$refs.firstname.focus());
  },
  methods: {
    ...mapActions('auth', [
      'fetchUserInfo',
      'login'
    ]),
    async submitLogin () {
      const { firstname, lastname, phoneNumber, email, password, passwordConfirmation } = this.form;
      this.loading = true;

      Object.keys(this.form).forEach((item) => {
        if (!this.form[item] && !this.error) {
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

      try {
        const res = await _.registerUser({ firstname, lastname, email, password, passwordConfirmation });
        console.log(res);
        // await this.fetchUserInfo();
        // await this.$router.push({ path: '/' });
      } catch (error) {
        console.log(error);
        this.$message({
          showClose: true,
          message: 'Oops, Bad credentials.',
          type: 'error'
        });
        this.loading = false;
      }
    }
  }
};
</script>

<style scoped>
  .loginContainer{
    height: 100%;
  }
</style>
