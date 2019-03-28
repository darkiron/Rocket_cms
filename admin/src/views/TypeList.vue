<template>
    <div>
        <h2>Liste</h2>
        <array  v-if="items.length" :items="items"></array>
        <div v-else class="alert">
          Aucuns résultats
        </div>
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
  data () {
    return {
      items: [],
    }
  },
  watch: {
    currentEndpoint () {
      this.fetchItems()
    }
  },
  computed: {
    endpointUrl () {
      return `http://localhost:8888${this.currentEndpoint.path}`
    }
  },
  methods:{
    fetchItems () {
      this.$store.dispatch('setLoading', true)
        axios.get(this.endpointUrl).then(r => {
          this.items = r.data;
          this.$store.dispatch('setLoading', false)
        })
    }
  }
}
</script>
