<template>
  <div class="container">
    <el-row>
      <h1 class="header">Qui sommes-nous ?</h1>
    </el-row>
    <el-card>
      <h3>
        <b>Quel est le projet FoodCollect et qui sommes-nous ?</b>
      </h3>
      <el-row>
        <p>
          Fait pour les producteurs et les usagers pendant cette période de confinement, FoodCollect vous permet de définir des points de collecte
          directement auprès des commerçants inscris sur le site. Choisissez votre jour et horaire de passage parmis ceux définis par le
          commerçant afin de faire vos courses directement, sans contact.
        </p>
        <p>
          Ce projet n'est pas seulement fait pour les usagers, mais également pour les producteurs. Accédez à une interface d'administration très complète,
          vous permettant d'ajouter des articles, de voir vos commandes en cours et gérer votre catalogue de produits.
        </p>
      </el-row>
      <h3>
        <b>Qui est derrière le projet ?</b>
      </h3>
      <el-row type="flex" justify="center" :gutter="40">
        <el-col :span="4" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
          <div class="avatar">
            <img />
            <h4>Louis</h4>
            <p>Développeur Fullstack à Wizards Technologies</p>
          </div>
        </el-col>
        <el-col :span="4" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
          <div class="avatar">
            <img />
            <h4>Jonathan</h4>
            <p>Développeur Fullstack à Wizards Technologies</p>
          </div>
        </el-col>
        <el-col :span="4" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
          <div class="avatar">
            <img />
            <h4>Théo</h4>
            <p>Développeur Fullstack à Wizards Technologies</p>
          </div>
        </el-col>
      </el-row>
      <el-row type="flex" justify="center" :gutter="40">
        <el-col :span="4" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
          <div class="avatar">
            <img />
            <h4>Valentin</h4>
            <p>Développeur Fullstack à Wizards Technologies</p>
          </div>
        </el-col>
        <el-col :span="4" :xs="24" :sm="24" :md="12" :lg="6" :xl="6">
          <div class="avatar">
            <img />
            <h4>Sylvain</h4>
            <p>Développeur Fullstack à Wizards Technologies</p>
          </div>
        </el-col>
      </el-row>
    </el-card>
  </div>
</template>
<script>
export default {
  name: 'About'
};
</script>

<style lang="scss" scoped>
.container {
  width: 100%;

  &--avatars {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
  }

  .avatar {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }
}

img {
  margin-bottom: 20px;
}
</style>
