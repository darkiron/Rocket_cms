<template>
  <div>
    <label :for="name" v-html="(value.label !== null) ? value.label : name"></label>
    <template v-if="type === 'text'">
      <input :type="type" :name="value.name" :id="name">
    </template>
    <template v-else-if="type === 'textarea'">
      <textarea :name="value.name" v-html="(value.value !== null) ? value.value : ''" :id="name"></textarea>
    </template>
    <template v-else>
      <select :name="value.name" :id="name">
        <option v-for="opt in value.values" :key="opt.value" :value="opt.value">
          {{ opt.label}}
        </option>
      </select>
    </template>
    <modalAdd v-if="endpoint" :endpoint="endpoint"></modalAdd>
  </div>
</template>
<script>

import modalAdd from './ModalAdd'

export default {
  name: 'formInput',
  props: ['value', 'name', 'endpoint'],
  components: {
    modalAdd
  },
  computed: {
    type () {
      let reg = new RegExp('\\w*$');
      let type  = reg.exec(this.value.type)[0];

      reg = new RegExp('.*[^Type]')
      type  = reg.exec(type)[0];

      return type.toLowerCase();
    }
  }
};
</script>
