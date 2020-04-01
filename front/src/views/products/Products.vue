<template>
  <div>
    <el-row>
      <h1>Tous les produits du restaurant sélectionné :</h1>
    </el-row>
    <el-card>
      <p class="category">Tous les produits</p>
      <el-table empty-text="No data" :data="products" border>
        <el-table-column prop="id" label="ID"></el-table-column>
        <el-table-column prop="type" label="Type"></el-table-column>
        <el-table-column prop="status" label="Status"></el-table-column>
        <el-table-column prop="startAt" label="From"></el-table-column>
        <el-table-column prop="endAt" label="To"></el-table-column>
        <el-table-column label="Actions">
          <template slot-scope="scope">
            <el-button size="mini" type="primary" @click="handleView(scope.$index, scope.row)">View</el-button>
            <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
          </template>
        </el-table-column>
      </el-table>
    </el-card>
  </div>
</template>

<script>
import { mapState, mapActions } from "vuex";

export default {
  name: "Products",
  computed: mapState({
    products: state => state.products.products
  }),
  methods: {
    ...mapActions("products", ["fetchProducts"]),
    handleEdit(index, row) {
      this.$router.push({ name: "products.edit", params: { id: row.id } });
    },
    handleView(index, row) {
      this.$router.push({ name: "products.show", params: { id: row.id } });
    }
  },
  created() {
    this.fetchProducts();
  }
};
</script>
