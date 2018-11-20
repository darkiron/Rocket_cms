<template>
  <div>
    <label :for="name" v-html="(value.label !== null) ? value.label : name"></label>
    <template v-if="type === 'text'">
      <input :type="type" :name="name" :id="name">
    </template>
    <template v-else-if="type === 'textarea'">
      <textarea :name="name" v-html="(value.value !== null) ? value.value : ''" :id="name"></textarea>
    </template>
    <template v-else>
      <select :name="name" :id="name">
        <option v-for="(opt, index) in value.values" :key="index" :value="opt" v-html="opt">
        </option>
      </select>
    </template>
  </div>
</template>
<script>
export default {
  name: 'formInput',
  props: ['value', 'name'],
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
