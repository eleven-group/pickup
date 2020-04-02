<template>
  <div>
  </div>
</template>

<script>
import authApi from '@/api/auth';
export default {
  name: 'ConfirmationToken',
  async created () {
    try {
      await authApi.getConfirmation(this.$route.params.token);
      this.$router.push('/');
      this.$message({
        message: 'Votre compte a été confirmé',
        center: true,
        type: 'success'
      });
    } catch (e) {
      console.error(e);
      this.$message({
        showClose: true,
        message: `Oops, something went wrong, please try again later or make a report`,
        type: 'error'
      });
    }
  }
};
</script>
