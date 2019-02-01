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
    'loading': 'fetchItems'
  },
  computed: {
    loading () {
      return this.$store.state.loading
    }
  },
  methods:{
    fetchItems() {
      if (!this.loading) {
        axios.get(`http://localhost:8888${this.$store.state.currentEndpoint.path}`).then(r => {
          this.items = r.data;
        })
      }
    }
  },
  mounted() {
    this.fetchItems()
  }
}
</script>
