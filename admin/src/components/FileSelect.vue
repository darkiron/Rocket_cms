<template>
  <div style="border: 4px solid red">
    <input :type="type" :name="name" :id="id">
  </div>
</template>
<script>
export default {
  name: 'file-select',
  props: ['type', 'name', 'id', 'value']
}
</script>

