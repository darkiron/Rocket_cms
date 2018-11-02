<template>
  <tr>
    <td v-for="(name, index) in list" v-html="item[name]" :key="index"></td>
  </tr>
</template>
<script>
export default {
  name: 'row',
  props: ['item'],
  computed: {
    list() {
      return Object.getOwnPropertyNames(this.item).filter(item => item !== '__ob__');
    },
  },
};
</script>
