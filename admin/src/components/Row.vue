<template>
  <tr>
    <td v-for="(name, index) in list" v-html="item[name]" :key="index"></td>
    <td>Edit</td>
    <td><Delete :id="item.id"/></td>
  </tr>
</template>
<script>
import Delete from '@/components/delete.vue';

export default {
  name: 'row',
  props: ['item'],
  components: {
    Delete
  },
  computed: {
    list() {
      return Object.getOwnPropertyNames(this.item).filter(item => item !== '__ob__');
    },
  },
};
</script>
