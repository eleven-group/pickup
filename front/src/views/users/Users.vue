<template>
  <div>
    <el-table
      v-loading=pending
      empty-text="No data"
      :data="users">
      <el-table-column
        prop="id"
        label="Id">
      </el-table-column>
      <el-table-column
        prop="username"
        label="Username">
      </el-table-column>
      <el-table-column
        label="Actions">
        <template slot-scope="scope">
          <el-button
            size="mini"
            type="primary"
            @click="handleView(scope.$index, scope.row)">View</el-button>
          <el-button
            size="mini"
            @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'Users',
  computed: mapState({
    users: state => state.users.users,
    pending: state => state.users.pending.users,
    error: state => state.users.error.users
  }),
  methods: {
    ...mapActions([
      'getUsers'
    ]),
    handleEdit (index, row) {
      this.$router.push({ name: 'users.edit', params: { id: row.id } });
    },
    handleView (index, row) {
      this.$router.push({ name: 'users.show', params: { id: row.id } });
    }
  },
  created () {
    this.getUsers();
  }
};
</script>
