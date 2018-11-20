<template>
  <nav>
    <ul>
      <li  v-for="(item, index) in navItems" :key="index" @click="setEndpoint(item)">
        <router-link :to="{ name:'typeList', params: { 'type': item.name}}">
          {{ item.name }}
        </router-link>
      </li>
    </ul>
  </nav>
</template>
<script>
import axios from 'axios';

export default {
  name: 'naviguation',
  data() {
    return {
      items: [],
    };
  },
  computed: {
    navItems() {
      const reg = new RegExp('(?!a?p?i?_)(.*)$')
      if(this.items.length) {
        return this.items.filter( (i) => {
          if (i.name.indexOf('crud') < 0 && i.name.indexOf('show') < 0 && i.name.indexOf('error') < 0 && i.name.indexOf('endpoint') < 0) {
            i.name = reg.exec(i.name)[0];
            return i;
          }
        });
      }
    },
  },
  methods: {
    setEndpoint(i) {
      this.$store.dispatch('setCurrentEndpoint', i);
    },
  },
  mounted() {
    axios.get('http://localhost:8888/api').then(
      (r) => {
        this.items = r.data;
      },
    );
  },
};
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
