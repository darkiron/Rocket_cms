<template>
  <div id="app">
    <div id="nav" data-after=" ">
      <ul>
        <li><router-link to="/">Home</router-link></li>
        <li><router-link to="/about">About</router-link></li>
      </ul>
      <div id="loader"></div>
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
  }
}
</script>
<style lang="scss">

$font-stack: 'Arial';
$back-color: #232323;
$font-color: #bbb;

html, body {
  height: 100%;
}

body{
  margin: 0;
  padding: 0;
  width: 100%;
  min-height: 100vh;
  color: $font-color;
  font-family: $font-stack;
  background-color: $back-color;

  #nav {
    width: 100%;
    height: 45px;
    display: flex;
    flex-direction: column;
    justify-content: center;

    ul {
      display: contents;
    }

    #loader {
      height: 5px;
      width: 100%;
      background: linear-gradient(to right, yellow, red);
      background-size: 200% 200%;
      background-position: 50% 50%;
      display: block;
      animation: loadAnimation 5s ease infinite;
    }
  }

  #app {
    min-height: 100%;

    .container {
      display: flex;

      .main {
        width: 100%;
        padding: 1rem;
      }
    }
  }
}

@keyframes loadAnimation {
  0%{background-position:0% 50%}
  50%{background-position:100% 51%; background-color: aqua;}
  100%{background-position:0% 50%}
}
</style>
