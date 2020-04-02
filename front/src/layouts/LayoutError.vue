<template>
  <el-container class="container">
    <el-main class="main">
      <div class="content">
        <p>Erreur 404</p>
        <router-view />
      </div>
      <div class="bg-img"></div>
    </el-main>
  </el-container>
</template>

<script>
export default {
  name: 'LayoutError'
};
</script>

<style lang="scss" scoped>
.el-main {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
  background-color: #000;
}

.bg-img {
  position: absolute;
  width: 100%;
  height: 100%;
  background: url(http://www.reactiongifs.us/wp-content/uploads/2015/04/nothing_to_see_here_naked_gun.gif)
    no-repeat center center fixed;
  background-size: cover;
  background-color: #000;
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.content {
  color: #fff;
  background-color: none;
  z-index: 2;
}

p {
  text-align: center;
  font-size: 120px;
  font-weight: 600;
}

.container,
.main {
  height: 100vh;
}
</style>
