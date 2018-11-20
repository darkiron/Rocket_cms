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
  watch: {
    '$route': 'fetchItems',
  },
  methods:{
    fetchItems() {
      axios.get(`http://localhost:8888${this.$store.state.currentEndpoint.path}`).then(
        (res) => {
          this.items = res.data;
        },
      );
    },
  },
  mounted() {
    this.fetchItems();
  },
};
</script>
