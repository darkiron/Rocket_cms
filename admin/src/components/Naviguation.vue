<template>
  <nav>
    <ul>
      <li  v-for="(name, index) in items" :key="index">
        <router-link :to="{ name:'typeList', params: { 'type': name}}">
          {{ name }}
        </router-link>
      </li>
    </ul>
  </nav>
</template>
<script>
import api from '@/api';

export default {
  name: 'naviguation',
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    api.lists.forEach( e => {
      this.items.push(e.name);
    });

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

