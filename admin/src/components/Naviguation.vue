<template>
  <nav class="side">
    <ul v-if="navItems.length">
      <li  v-for="(item, index) in navItems" :key="index">
        <router-link :to="{ name:'typeList', params: { 'type': item.htmlName ? item.htmlName : item.name}}">
          <template v-if="item.htmlName">{{ item.htmlName }}</template>
          <template v-else>{{ item.name }}</template>
        </router-link>
      </li>
    </ul>
    <div v-else-if="!loading && !navItems.length" class="alert"> Un probléme est survenue, vérifier la connexion à l'api</div>
  </nav>
</template>
<script>
import axios from 'axios';

export default {
  name: 'naviguation',
  computed: {
    navItems () {
      const reg = new RegExp('(?!a?p?i?_)(.*)$')
      const items = this.$store.state.endpoints
      if(items.length) {
        return items.filter( (i) => {
          if (i.name.indexOf('crud') < 0 && i.name.indexOf('show') < 0 && i.name.indexOf('error') < 0 && i.name.indexOf('endpoint') < 0) {
            // i.name = reg.exec(i.name)[0]
            i.htmlName = reg.exec(i.name)[0]
            return i
          }
        })
      }
      return []
    },
  }
}
</script>
<style lang="scss">


$font-stack: 'Arial';
$back-color: #232323;
$font-color: #bbb;


.side {
  width: 14rem;

  ul {
    display: inline-block;
    padding: 0;
    list-style: none;
    display: flex;
    flex-direction: column;
    justify-content: center;

    li {
      height: 2rem;
      padding: 0 2rem;
      display: flex;
      align-items: center;

      a {
        text-decoration: none;
        color: $font-color;
        width: 100%;
      }

      &:hover {
        background-color: #3d8263;
      }
    }
  }

  .alert {
    color: red;
    padding: 1rem;
    border: 1px solid red;
    text-align: center;
    background-color: rgba(243, 37, 37, 0.49);
    margin: 2rem auto;
    display: flex;
    flex-direction: column;

    &:before {
      content: "!";
    }
  }

}
</style>
