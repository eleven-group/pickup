<template>
  <div>
    <el-row>
      <h1 class="header">
        Bravo, votre commande est enregistrée !
        <br />Pour la valider vous devez cliquer sur le lien qui se trouve dans l'email que nous venons de vous envoyer.
      </h1>
      <el-button type="primary" @click="$router.push('/')" plain>Retour sur la page d'accueil</el-button>
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
  name: 'Confirmation'
};
</script>
