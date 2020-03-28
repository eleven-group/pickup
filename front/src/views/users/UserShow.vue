<template>
      <div v-loading:pending>
        Hello, {{ user.id }}
      </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
  name: 'UserShow',
  computed: mapState({
    user: state => state.users.user,
    pending: state => state.users.pending.user,
    error: state => state.users.error.user
  }),
  methods: {
    ...mapActions([
      'getUser'
    ])
  },
  created () {
    this.getUser({ params: { id: 1 } });
  }
};
</script>
