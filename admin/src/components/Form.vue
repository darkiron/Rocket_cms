<template>
  <div>
    <FormInput v-for="(input, index) in form" :key="index" />

    <button type="submit" @click="submit">Save</button>
  </div>
</template>
<script>
import api from '@/api';
import FormInput from '@/components/FormInput.vue';

export default {
  name: 'Form',
  components: {
    FormInput,
  },
  data() {
    return {
      form: [],
      action: '',
    };
  },
  methods: {
    submit() {
      console.log('toto');
    },
  },
  mounted() {
    this.action = api.getRoute(this.$route.params.type, 'add');
    this.form = api.getForm(this.$route.params.type);
  },
};
</script>
