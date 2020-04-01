<template>
  <div>
    <el-row>
      <h1>Tous les produits du restaurant sélectionné :</h1>
    </el-row>
    <el-row :gutter="40">
      <el-col :span="24" :xs="12" :sm="24" :md="24" :lg="18" :xl="18">
        <el-card>
          <p class="category">Contenu du panier</p>
          <el-table :data="tableData" style="width: 100%">
            <el-table-column label="Catégorie">
              <template slot-scope="scope">
                <span style="margin-left: 10px">{{ scope.row.type }}</span>
              </template>
            </el-table-column>
            <el-table-column label="Nom">
              <template slot-scope="scope">
                <div slot="reference" class="name-wrapper">
                  <el-tag size="medium">{{ scope.row.name }}</el-tag>
                </div>
              </template>
            </el-table-column>
            <el-table-column label="Prix">
              <template slot-scope="scope">
                <span>{{ scope.row.price }}</span>
              </template>
            </el-table-column>
            <el-table-column align="right" label="Opérations">
              <template slot-scope="scope">
                <el-button
                  size="mini"
                  type="success"
                  @click="handleEdit(scope.$index, scope.row)"
                >Ajouter</el-button>
                <el-button
                  size="mini"
                  type="danger"
                  @click="handleDelete(scope.$index, scope.row)"
                >Supprimer</el-button>
              </template>
            </el-table-column>
          </el-table>
        </el-card>
      </el-col>
      <el-col :span="24" :xs="24" :sm="24" :md="24" :lg="6" :xl="6">
        <el-card class="price reversed">
          <p class="category">Total</p>
          <p>Le total de votre commande (à payer chez votre commerçant) est donc fixé à :</p>
          <span>999, 99€</span>
          <div class="el-card--button">
            <el-button type="primary">Effectuer la réservation</el-button>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tableData: [
        {
          type: "Catégorie produit",
          name: "Tom",
          prix: "13,99€ TTC",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          type: "Catégorie produit",
          name: "Tom",
          prix: "13,99€ TTC",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          type: "Catégorie produit",
          name: "Tom",
          prix: "13,99€ TTC",
          address: "No. 189, Grove St, Los Angeles"
        },
        {
          type: "Catégorie produit",
          name: "Tom",
          prix: "13,99€ TTC",
          address: "No. 189, Grove St, Los Angeles"
        }
      ]
    };
  },
  methods: {
    handleEdit(index, row) {
      console.log(index, row);
    },
    handleDelete(index, row) {
      console.log(index, row);
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

.price {
  @media (min-width: 1200px) {
    position: sticky;
  }

  button {
    width: 100%;
  }

  span {
    display: block;
    margin-bottom: 28px;
    font-size: 24px;
    font-weight: 600;
    text-align: right;
  }
}
</style>
