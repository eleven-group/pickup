<template>
  <div>
    <el-row>
      <h1 class="header">
        Bravo, vous avez validé votre e-mail !
        <br />Vous pouvez dès maintenant parcourir notre application en toute liberté,
        mais vous pouvez également accéder à votre "espace producteurs".
      </h1>
      <el-button type="primary" @click="redirect" plain>Connectez-vous dès maintenant</el-button>
    </el-row>
  </div>
</template>

<style lang="scss" scoped>
h1 {
  margin-bottom: 80px;
}

div {
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.el-button {
  width: 40%;
}
</style>

<script>
export default {
  name: 'ConfirmationRegister',
  methods: {
    redirect () { window.location.replace(`${process.env.VUE_APP_ADMIN_URL}/login`); }
  }
};
</script>
