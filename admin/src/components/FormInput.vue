<template>
  <div>
    <label :for="InputName" v-html="(value.label !== null) ? value.label : value.name"></label>
    <template v-if="type === 'text' || type == 'datetime'">
      <input :type="type" :name="InputName" :id="value.name">
    </template>
    <template v-else-if="type === 'textarea'">
      <textarea :name="InputName" v-html="(value.value !== null) ? value.value : ''" :id="value.name"></textarea>
    </template>
     <template v-else-if="type === 'file'">
      <fileSelect :name="InputName" :type="type" :id="value.name" :value="value.value"  />
    </template>
    <template v-else>
      <select :name="InputName" :id="value.name" :multiple="value.multiple">
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
import fileSelect from './FileSelect'

export default {
  name: 'formInput',
  props: ['value', 'name', 'endpoint'],
  components: {
    modalAdd,
    fileSelect,
  },
  computed: {
    InputName () {
      if (this.value.multiple) {
        return `${this.value.name}[]`
      }
      return this.value.name
    },
    type () {
      let reg = new RegExp('\\w*$')
      let type  = reg.exec(this.value.type)

      reg = new RegExp('.*(?=Type)')
      type  = reg.exec(type[0])

      return type[0].toLowerCase()
    }
  }
};
</script>
