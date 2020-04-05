<template>
  <div>
  </div>
</template>

<script>
import authApi from '@/api/auth';
export default {
  name: 'BookingTokenCancelation',
  async created () {
    try {
      await authApi.getCanceledBooking(this.$route.params.token);
      window.location.replace(`${process.env.VUE_APP_ADMIN_URL}/login`);
      this.$message({
        message: 'Votre commande a bien été annulée, vous allez recevoir un email recapitulatif.',
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
