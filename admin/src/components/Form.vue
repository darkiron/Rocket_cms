<template>
  <form>
    <FormInput
      v-for="(input, index) in form"
      :key="index"
      :value="input"
      :name="index"
    />
    <button
      type="submit"
      @click="submit"
    >Save</button>
  </form>
</template>
<script>
import axios from 'axios'
import FormInput from './FormInput.vue'


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
    submit (e) {
      e.preventDefault();
      const formValue = {};

      Object.keys(this.form).forEach((item) => {
        formValue[`${item}`] = document.getElementById(item).value;
      });
      axios({
        method: 'post',
        url: this.action,
        data: formValue,
        headers: {
          'Content-Type': 'text/plain;charset=utf-8',
        },
      });
    }
  },
  mounted () {
    /* this.action = api.getRoute(this.$route.params.type, 'add'); */
    axios.get(`http://localhost:8888/api?search=${this.$store.state.currentEndpoint.name}_add`).then(
      (r) => {
        this.action = `http://localhost:8888${r.data[0].path}`;
        axios.get(this.action).then(
          (r) => {
            this.form = r.data;
          }
        )
      }
    )
  },
};
</script>
