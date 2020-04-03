<template>
  <div>
    <el-row>
      <h1 class="header">
        Vous êtes producteur ? Vous souhaitez mettre vos articles à disposition
        ?
        <br />Inscrivez-vous dès maintenant.
      </h1>
    </el-row>
    <el-form @submit.prevent.native="submitLogin">
      <el-row :gutter="40">
        <el-col :span="12" :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
          <el-card>
            <p class="category">Détails personnels</p>
            <el-form-item>
              <el-input
                id="firstname"
                placeholder="Entrez votre prénom..."
                ref="firstname"
                v-model="form.user.firstname"
              ></el-input>
            </el-form-item>
            <el-form-item>
              <el-input
                id="lastname"
                placeholder="Entrez votre nom..."
                ref="lastname"
                v-model="form.user.lastname"
              ></el-input>
            </el-form-item>
            <el-form-item>
              <el-input
                id="email"
                placeholder="Entrez votre e-mail..."
                ref="email"
                v-model="form.user.email"
              ></el-input>
            </el-form-item>
            <el-row :gutter="16">
              <el-col :span="12" :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                <el-form-item prop="pass">
                  <el-input
                    id="password"
                    placeholder="Mot de passe"
                    ref="password"
                    v-model="form.user.password"
                    autocomplete="off"
                    show-password
                  ></el-input>
                </el-form-item>
              </el-col>
              <el-col :span="12" :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                <el-form-item>
                  <el-input
                    id="passwordConfirmation"
                    placeholder="Confirmer de mot de passe"
                    ref="passwordConfirmation"
                    v-model="form.user.passwordConfirmation"
                    autocomplete="off"
                    show-password
                  ></el-input>
                </el-form-item>
              </el-col>
            </el-row>
          </el-card>
        </el-col>

        <el-col :span="12" :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
          <el-card>
            <p class="category">Votre entreprise</p>
            <div>
              <el-form-item>
                <el-input
                  id="name"
                  placeholder="Quel est le nom de votre entreprise ?"
                  ref="name"
                  v-model="form.shop.name"
                ></el-input>
              </el-form-item>
              <el-form-item>
                <el-input
                  id="description"
                  placeholder="Décrivez de manière rapide votre commerce !"
                  ref="description"
                  v-model="form.shop.description"
                  type="textarea"
                  :autosize="{ minRows: 3, maxRows: 4 }"
                  maxlength="200"
                  show-word-limit
                ></el-input>
              </el-form-item>

              <el-row :gutter="16" class="address">
                <el-col :span="8" :xs="24" :sm="24" :md="12" :lg="8" :xl="8">
                  <el-input
                    id="streetAdress"
                    placeholder="Adresse"
                    ref="streetAdress"
                    v-model="form.shop.streetAdress"
                  ></el-input>
                </el-col>
                <el-col :span="8" :xs="24" :sm="24" :md="12" :lg="8" :xl="8">
                  <el-input
                    id="postalCode"
                    placeholder="Code postal"
                    ref="postalCode"
                    v-model="form.shop.postalCode"
                  ></el-input>
                </el-col>
                <el-col :span="8" :xs="24" :sm="24" :md="24" :lg="8" :xl="8">
                  <el-input id="city" placeholder="Ville" ref="city" v-model="form.shop.city"></el-input>
                </el-col>
              </el-row>
              <el-select
                id="category"
                placeholder="Sélectionnez la catégorie de votre restaurant"
                ref="city"
                v-model="form.shop.category"
              >
                <el-option
                  v-for="category in categories"
                  :key="category"
                  :label="category"
                  :value="category"
                ></el-option>
              </el-select>
            </div>
          </el-card>
        </el-col>
      </el-row>

      <el-row :gutter="20">
        <el-col :span="24" class="delivery">
          <el-card>
            <p class="category">Vos horaires</p>
            <div v-for="(content, day) in form.shop.openingHours" :key="day">
              <el-col
                cls:span="8"
                :xs="24"
                :sm="24"
                :md="24"
                :lg="8"
                :xl="8"
                class="delivery-individual"
              >
                <el-card>
                  <label class="category" :for="day">{{ day }} morning</label>
                  <el-row :gutter="20">
                    <el-col :span="12">
                      <el-time-select
                        :id="`${day}MorningOpening`"
                        :ref="`${day}MorningOpening`"
                        is-range
                        placeholder="Opening"
                        v-model="form.shop.openingHours[day].morning.opening"
                        :picker-options="{
                          start: '04:00',
                          step: '00:30',
                          end: '14:00'
                        }"
                      ></el-time-select>
                    </el-col>

                    <el-col :span="12">
                      <el-time-select
                        :id="`${day}MorningClosing`"
                        :ref="`${day}MorningClosing`"
                        is-range
                        placeholder="Closing"
                        v-model="form.shop.openingHours[day].morning.closing"
                        :picker-options="{
                          start: '04:00',
                          step: '00:30',
                          end: '14:00',
                          minTime: form.shop.openingHours[day].morning.opening
                        }"
                      ></el-time-select>
                    </el-col>
                  </el-row>

                  <label :for="day" class="category">{{ day }} afternoon</label>

                  <el-row :gutter="20">
                    <el-col :span="12">
                      <el-time-select
                        :id="`${day}AfternoonOpening`"
                        :ref="`${day}AfternoonOpening`"
                        is-rangeclass="category"
                        placeholder="Opening"
                        v-model="form.shop.openingHours[day].afternoon.opening"
                        :picker-options="{
                          start: '14:00',
                          step: '00:30',
                          end: '23:00'
                        }"
                      ></el-time-select>
                    </el-col>
                    <el-col :span="12">
                      <el-time-select
                        :id="`${day}AfternoonClosing`"
                        :ref="`${day}AfternoonClosing`"
                        is-range
                        placeholder="Closing"
                        v-model="form.shop.openingHours[day].afternoon.closing"
                        :picker-options="{
                          start: '14:00',
                          step: '00:30',
                          end: '23:00',
                          minTime: form.shop.openingHours[day].afternoon.opening
                        }"
                      ></el-time-select>
                    </el-col>
                  </el-row>
                </el-card>
              </el-col>
            </div>
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
              }"
            ></el-time-select>
          </el-card>
        </el-col>
      </el-row>
      <el-button native-type="submit" type="primary" :loading="loading">Valider l'inscription</el-button>
    </el-form>
  </div>
</template>

<style lang="scss" scoped>
.address {
  display: block;
  margin-bottom: 22px;
}

.delivery {
  &-individual {
    padding: 20px;
    .el-row {
      margin-bottom: 16px;
    }

    .el-card {
      border: 1px solid #f1f1f5;
      padding-bottom: 0px;
    }

    label {
      display: inline-block;
      padding-bottom: 12px;
      ~ .el-row {
        margin-bottom: 24px;
      }
    }
  }
}

.el-date-editor,
.el-select {
  width: 100%;
}
</style>

<script>
import userApi from '@/api/users';
import osmApi from '@/api/location';
import getSlotToMin from '@/helpers/getSlotToMin';
import checkHours, { checkPartDay } from '@/helpers/checkHours';

export default {
  name: 'Login',
  data () {
    return {
      categories: [
        'Baker',
        'Butcher',
        'Burger',
        'Pastry',
        'Pizza',
        'Producer',
        'Other'
      ],
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
          category: '',
          openingHours: {
            monday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            tuesday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            wednesday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            thursday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            friday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            saturday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            },
            sunday: {
              morning: { opening: '', closing: '' },
              afternoon: { opening: '', closing: '' }
            }
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

      Object.keys(user).forEach(item => {
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
          message:
            "Oops, seems that your company adress can't be found, let's check your informations !",
          type: 'error'
        });
        this.loading = false;
        return;
      }
      Object.keys(shop).forEach(item => {
        if (item === 'openingHours') {
          Object.keys(shop[item]).forEach(day => {
            if (checkHours(shop, item, day)) {
              if (checkPartDay(shop, item, day, 'morning')) {
                shop[item][day].morning[0] = `${shop[item][day].morning.opening}`;
                shop[item][day].morning[1] = `${shop[item][day].morning.closing}`;
                shop[item][day].morning = `${shop[item][day].morning[0]}-${shop[item][day].morning[1]}`;
              }
              if (checkPartDay(shop, item, day, 'afternoon')) {
                shop[item][day].afternoon[0] = `${shop[item][day].afternoon.opening}`;
                shop[item][day].afternoon[1] = `${shop[item][day].afternoon.closing}`;
                shop[item][day].afternoon = `${shop[item][day].afternoon[0]}-${this.form.shop[item][day].afternoon[1]}`;
              }
              const morning = shop[item][day].morning
                ? shop[item][day].morning
                : '';
              const afternoon = shop[item][day].afternoon
                ? shop[item][day].afternoon
                : '';
              shop[item][day] = [morning, afternoon];
              this.isWeekEmpty = false;
            } else {
              shop[item][day] = ['', ''];
            }
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
      if (!/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(.\w{2,3})+$/.test(user.email)) {
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
        await userApi.registerUser(user, {
          ...shop,
          longitude: this.longitude.toString(),
          latitude: this.latitude.toString()
        });
        await this.$router.push({ path: '/confirmation-register' });
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
