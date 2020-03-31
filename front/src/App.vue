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
html,
body,
#app {
  margin: 0;
  padding: 0;
  min-height: 100vh;
  background-color: #fafafb;
}
</style>
