<template>
    <el-row justify="center" align="middle" type="flex" class="el-row loginContainer">
      <el-col :span="6">
        <el-card class="box-card">
          <div slot="header" class="clearfix">
            <h2>Wizards Technologies</h2>
            <h4>Welcome back!</h4>
          </div>
          <div>
            <el-form @submit.prevent.native=submitLogin>
              <label for="username">Nom d'utilisateur</label>
              <el-input id="username" ref="username" class="m-5" v-model="form.username"></el-input>
              <label for="password">Mot de passe</label>
              <el-input id="password" ref="password" class="m-5" v-model="form.password" show-password></el-input>
              <el-button native-type="submit" type="primary" :loading="loading">Connexion</el-button>
            </el-form>
          </div>
        </el-card>
      </el-col>
    </el-row>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'Login',
  data () {
    return {
      form: {
        username: '',
        password: ''
      },
      loading: false
    };
  },
  mounted () {
    this.$nextTick(() => this.$refs.username.focus());
  },
  methods: {
    ...mapActions('auth', [
      'fetchUserInfo',
      'login'
    ]),
    async submitLogin () {
      const { username, password } = this.form;
      this.loading = true;

      if (!username) {
        this.$message({
          showClose: true,
          message: 'Please enter your username.',
          type: 'error'
        });
        this.$refs.username.focus();
        this.loading = false;
        return;
      }

      if (!password) {
        this.$message({
          showClose: true,
          message: 'Please enter your password.',
          type: 'error'
        });
        this.$refs.password.focus();
        this.loading = false;
        return;
      }

      try {
        await this.login({ username, password });
        await this.fetchUserInfo();
        await this.$router.push({ path: '/' });
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
