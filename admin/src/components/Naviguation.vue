<template>
  <nav>
    <ul>
      <li  v-for="(item, index) in navItems" :key="index">
        <router-link :to="{ name:'typeList', params: { 'type': item.htmlName ? item.htmlName : item.name}}">
          <template v-if="item.htmlName">{{ item.htmlName }}</template>
          <template v-else>{{ item.name }}</template>
        </router-link>
      </li>
    </ul>
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
    },
  }
}
</script>
<style lang="scss">
  nav{
    width: 15rem;
    background-image: linear-gradient(#3ab980, #34495f);
    ul{
      list-style: none;
      margin: 0;
      padding: 0;

      li{
        border-bottom: #34495f 1px solid;
        height: 3rem;
        margin: 0;

        a{
          text-decoration: none;
          color:#34495f;
          text-transform: capitalize;
          display: flex;
          justify-content: left;
          align-items: center;
          height: 100%;
          width:100%;
          padding: 0 2rem;
        }
      }
    }
  }
</style>
