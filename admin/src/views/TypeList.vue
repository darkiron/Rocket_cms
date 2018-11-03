<template>
    <div>
        <h2>Liste</h2>

        <array :items="items"></array>
    </div>
</template>
<script>
import axios from 'axios';
import array from '@/components/Array.vue';
import api from '@/api';

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
    axios.get(api.getRoute(this.$route.params.type)).then(
      (res) => {
        this.items = res.data;
      },
    );
  },
};
</script>
