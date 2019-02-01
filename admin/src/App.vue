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
import Naviguation from '@/components/Naviguation.vue'

export default {
  name: 'App',
  components: {
    Naviguation,
  },
  created () {

  },
}
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

#nav {
  position: sticky;
  top: 0;
  width: 100%;
  height: 50px;
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  background: #ffffff;
}

.container{
  display: flex;
  width: 100%;
  min-height: 100vh;
}

.main {
  display: flex;
  flex-direction: column;
  background-color: #1e262d;
  color: #cac5c5;
  flex-grow: 1;
}
</style>
