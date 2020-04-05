<template>
  <div>
  </div>
</template>

<script>
import authApi from '@/api/auth';
export default {
  name: 'BookingTokenConfirmation',
  async created () {
    try {
      await authApi.getConfirmationBooking(this.$route.params.token);
      this.$router.push('home');
      this.$message({
        message: 'Votre commande a été confirmée, vous allez recevoir un email recapitulatif.',
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
