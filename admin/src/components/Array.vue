<template>
  <table>
    <tr>
      <th v-for="(name, index) in header" :key="index" v-html="name"></th>
    </tr>
    <row v-for="(item, index) in items" :key=index :item="item" />
  </table>
</template>
<script>
import Row from '@/components/Row.vue';

export default {
  name: 'array',
  props: ['items'],
  components: {
    row: Row,
  },
  computed: {
    header() {
      if (this.items.length) {
        const header = Object.getOwnPropertyNames(this.items[0]);
        return header.filter(item => item !== '__ob__');
      }

      return [];
    },
  },
};
</script>
