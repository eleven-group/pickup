<template>
  <div>
    <el-row>
      <h1 class="header">
        Bravo, plus qu'une dernière étape !
        <br />Vous allez recevoir un email permettant de valider votre compte ainsi qu'un identifiant qui vous permettra de vous connecter a votre espace d'admin !
      </h1>
      <el-button type="primary" @click="redirect" plain>Retour à l'acceuil</el-button>
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
    redirect () { window.location.replace('/'); }
  }
};
</script>
