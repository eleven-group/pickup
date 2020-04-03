<template>
  <div>
    <el-row>
      <h1>Tous les produits du restaurant sélectionné :</h1>
    </el-row>
    <el-row :gutter="40">
      <el-col :span="24" :xs="24" :sm="24" :md="24" :lg="18" :xl="18">
        <el-card>
          <p class="category">Contenu du panier</p>
          <el-table :data="products" style="width: 100%">
            <el-table-column label="Nom" width="180">
              <template slot-scope="scope">
                <span style="margin-left: 10px">{{ scope.row.name }}</span>
              </template>
            </el-table-column>
            <el-table-column label="Quantité" width="180">
              <template slot-scope="scope">
                <span style="margin-left: 10px">{{ scope.row.ordered }}</span>
              </template>
            </el-table-column>
            <el-table-column label="Prix" width="180">
              <template slot-scope="scope">
                <span style="margin-left: 10px">{{ scope.row.priceConverted }}</span>
              </template>
            </el-table-column>
            <el-table-column label="Opérations">
              <template slot-scope="scope">
                <el-button
                  v-if="scope.row.ordered > 1"
                  size="mini"
                  type="danger"
                  @click="handleDeleteOne(scope.$index)"
                >Retirer 1</el-button>
                <el-button
                  size="mini"
                  type="danger"
                  @click="handleDeleteAll(scope.row.id)"
                >Supprimer</el-button>
              </template>
            </el-table-column>
          </el-table>
        </el-card>
      </el-col>
      <el-col :span="24" :xs="24" :sm="24" :md="24" :lg="6" :xl="6">
        <el-card class="price">
          <p class="category">Total</p>
          <p>Le total de votre commande (à payer chez votre commerçant) est donc fixé à :</p>
          <span>{{totalPrice/100}}€</span>
          <el-input id="firstname" placeholder="Prénom" ref="firstname" v-model="form.firstname"></el-input>
          <el-input id="lastname" placeholder="Nom" ref="lastname" v-model="form.lastname"></el-input>
          <el-input id="email" placeholder="E-mail" ref="email" v-model="form.email"></el-input>
          <el-input
            id="phonenumber"
            placeholder="Téléphone"
            ref="phonenumber"
            v-model="form.phonenumber"
          ></el-input>
          <div class="el-card--buttons">
            <el-cascader
              v-model="value"
              placeholder="Choix de tranche horaire"
              :options="slots"
              :props="{ expandTrigger: 'hover' }"
            ></el-cascader>
            <el-button type="primary" @click="handleSumbit">Effectuer la réservation</el-button>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import shopApi from '@/api/shops';
import bookingApi from '@/api/booking';
import { mapState } from 'vuex';
import getPriceConverted from '@/helpers/getPriceConverted';
import bookingItemsBuilder from '@/helpers/bookingItemsBuilder';

export default {
  data () {
    return {
      form: {
        firstname: '',
        lastname: '',
        phonenumber: '',
        email: '',
        date: ''
      },
      slots: [],
      value: '',
      totalPrice: 0
    };
  },
  computed: mapState({
    products: state => state.cart.cartProducts
  }),
  methods: {
    formatProduct () {
      this.totalPrice = 0;
      this.products.forEach(product => {
        if (typeof product.price === 'number') {
          product.priceConverted = getPriceConverted(product.price);
        }
        this.totalPrice += product.price * product.ordered;
      });
    },
    handleDeleteAll (productId) {
      this.$store.commit('cart/deleteCartProduct', productId);
      window.location.reload(); // to be removed if we find a better way cause i've no idea it's 5am
    },
    handleDeleteOne (index) {
      this.$store.commit('cart/deleteOne', index);
      this.formatProduct();
    },
    async handleSumbit () {
      this.error = false;
      this.form.date = this.value ? this.value[1] : '';
      Object.keys(this.form).forEach(item => {
        if (!this.form[item] && !this.error) {
          this.$message({
            showClose: true,
            message: `Please enter your ${item}.`,
            type: 'error'
          });
          this.error = true;
          if (item !== 'date') this.$refs[`${item}`].focus();
        }
      });
      if (
        !/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(.\w{2,3})+$/.test(this.form.email) &&
        !this.error
      ) {
        this.$message({
          showClose: true,
          message: `Your email has a wrong format (e.g. john@smith.usa)`,
          type: 'error'
        });
        this.error = true;
        this.$refs.email.focus();

        return;
      }
      if (!this.error) {
        try {
          await bookingApi.postBooking({
            ...this.form,
            status: 'pending',
            total: this.totalPrice,
            bookingItem: bookingItemsBuilder(this.products)
          });
          this.$store.commit('cart/clearState');
          this.$router.push('/confirmation-booking');
        } catch (e) {
          this.$message({
            showClose: true,
            message: `Oups, une erreur est survenue, réessayez plus tard ou contactez-nous !`,
            type: 'error'
          });
          this.error = true;
        }
      }
    }
  },
  async created () {
    this.formatProduct();
    try {
      const res = await shopApi.getSlots(1, 1);
      this.slots = res.data.slots;
    } catch (error) {
      this.$message({
        showClose: true,
        message: 'Oops, something went wrong. Try again later or report a bug',
        type: 'error'
      });
      this.loading = false;
    }
  }
};
</script>

<style lang="scss" scoped>
th {
  font-weight: 500 !important;
}

.el-table-column:last-child {
  text-align: right;
}

.el-card {
  &.reversed {
    background-color: #0062ff;

    p,
    span {
      color: #ffffff;
    }

    button {
      background-color: #ffffff;
      border-color: #ffffff;
      color: #0062ff;
    }
  }
}

.el-card--buttons {
  .el-cascader {
    margin-bottom: 12px;
    width: 100%;
  }
  &::placeholder {
    color: #0062ff !important;
  }
  border-radius: 10px !important;
}

.price {
  @media (min-width: 1200px) {
    position: sticky;
  }

  button {
    width: 100%;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  span {
    display: block;
    margin-bottom: 28px;
    font-size: 24px;
    font-weight: 600;
    text-align: right;
  }

  .el-input {
    margin-bottom: 12px;
  }
}
</style>
