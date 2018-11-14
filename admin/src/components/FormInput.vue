<template>
  <div>
    <template v-if="value.type !== 'select'">
      <input :type="value.type" :name="value.name">
    </template>
    <template v-else>
      <select :name="value.name">
        <option v-for="(opt, index) in value.values" :key="index" :value="opt" v-html="opt"></option>
      </select>
    </template>
  </div>
</template>
<script>
export default {
  name: 'formInput',
  props: ['value'],
}
</script>

