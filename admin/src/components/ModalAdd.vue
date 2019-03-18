<template>
  <div>
    <button @click="openModal">add</button>
    <div id="modal">
      <Form :endPoint="endpoint"></Form>
    </div>
  </div>
</template>
<script>

import Form from './Form.vue';

export default {
  name: 'modalAdd',
  props: ['endpoint'],
  components: {
    Form
  },
  methods: {
    openModal (event) {
      event.preventDefault();
      alert('foo')
      document.getElementById('modal')
    }
  }
}
</script>


