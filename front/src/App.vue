<template>
  <div id="app">
      <router-view />
  </div>
</template>

<script>

export default {
  name: 'App'
};
</script>

<style lang="scss">

html, body, #app {
  margin: 0;
  padding: 0;
  min-height: 100vh;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.m-5 {
  margin-top: 10px;
  margin-bottom: 10px;
}

</style>
