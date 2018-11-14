<template>
  <form>
    <FormInput v-for="(input, index) in form" :key="index" :value="input" />
    <button type="submit" @click="submit">Save</button>
  </form>
</template>
<script>
import api from '@/api';
import FormInput from '@/components/FormInput.vue';
import axios from 'axios';

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
    submit(e) {
      e.preventDefault();
      let formValue = {};
      this.form.forEach( item => {
        formValue[`${item.name}`] =document.getElementsByName(item.name)[0].value;
      });
      axios({
        method: 'post',
        url: this.action,
        data: formValue,
        headers: {
            'Content-Type': 'text/plain;charset=utf-8',
        },
      })
    },
  },
  mounted() {
    this.action = api.getRoute(this.$route.params.type, 'add');
    this.form = api.getForm(this.$route.params.type);
  },
};
</script>
