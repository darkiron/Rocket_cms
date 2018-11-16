<template>
  <div id="app">
    <div id="nav">
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </div>
    <div class="container">
      <Naviguation/>
      <router-view/>
    </div>
  </div>
</template>
<script>

import Naviguation from '@/components/Naviguation.vue';

export default {
  name: 'App',
  components: {
    Naviguation,
  },
};
</script>

<style lang="scss">
body {
  margin: 0;
  padding: 0;
}

#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  display: flex;
  flex-direction: column;
  margin: 0;
  padding: 0;
}

.container{
  display: flex;
}

.main {
  display: flex;
  flex-direction: column;
  background-color: #1e262d;
  color: #cac5c5;
  flex-grow: 1;
}
</style>
