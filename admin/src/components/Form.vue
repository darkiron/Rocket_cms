<template>
  <form>
    <FormInput
      v-for="(input, index) in form"
      :key="index"
      :value="input"
      :name="index"
      :endpoint=hasaddType(input)
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
  props: ['endpoint'],
  data() {
    return {
      form: [],
      addTypes: [],
    }
  },
  watch: {
    currentEndpoint () {
      this.setForm()
    },
    form () {
      if (this.form.length) this.setAddType()
    }
  },
  methods: {
    hasaddType (input) {
      return this.addTypes.filter(i => {
        if (i.label === input.label) return i
      })[0]
    },
    setAddType () {
      const reg = new RegExp('(\\w*)$')
      this.form.forEach(i => {
        if (i.hasOwnProperty('type') && i.type.indexOf('EntityType') >= 0){
          const searchName = reg.exec(i.class)[0]
          let search = []
          for (let i = 0; i < searchName.length; i++) {
            if (searchName[i] === searchName[i].toUpperCase() && i > 1) {
              search.push('_')
            }
            search.push(searchName[i].toLowerCase())
          }
          search = search.join('')
          this.$store.dispatch('searchEndPoint', { type: search, rName: 'typeAdd' }).then(r => {
            if (r.length) {
              r[r.length - 1].label = i.label
              this.addTypes.push(r[r.length - 1])
            }
          })
        }
      })
    },
    setForm() {
      this.form = []
      if (this.currentEndpoint.hasOwnProperty('path')) {
        this.$store.dispatch('setLoading', true)
        axios.get(this.action).then(r => {
          Object.keys(r.data).forEach(k => {
            r.data[k].label = k
            this.form.push(r.data[k])
            this.$store.dispatch('setLoading', false)
          })
        })
      }
    },
    submit (e) {
      e.preventDefault();
      const formValue = {};
      this.form.forEach((item, key) => {
        formValue[`${item.name}`] = document.getElementById(key).value;
      });
      this.$store.dispatch('setLoading', true)
      axios({
        method: 'post',
        url: this.action,
        data: formValue,
        headers: {
          'Content-Type': 'text/plain;charset=utf-8',
        },
      }).then(() => {
        this.$store.dispatch('setLoading', false)
      });
    }
  },
  computed: {
    action () {
      return `http://localhost:8888${this.currentEndpoint.path}`
    }
  },
  mounted () {
    this.setForm()
  }
}
</script>
