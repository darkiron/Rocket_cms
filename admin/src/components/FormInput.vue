<template>
  <div>
    <template v-if="type !== 'select'">
      <input v-type="type" v-name="name">
    </template>
  </div>
</template>
<script>
export default {
  name: 'formInput',
  props: ['value', 'type', 'name', 'defaults']
}
</script>

