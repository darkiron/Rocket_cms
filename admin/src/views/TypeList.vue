<template>
    <div>
        <h2>Liste</h2>

        <array :items="items"></array>
    </div>
</template>
<script>
import axios from 'axios';
import array from '@/components/Array.vue';

export default {
  name: 'listType',
  components: {
    array,
  },
  data() {
    return {
      items: [],
    };
  },
  mounted() {
    axios.get('http://localhost:8888/api/types').then(
      (res) => {
        this.items = res.data;
      },
    );
  },
};
</script>
