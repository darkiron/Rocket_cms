<template>
    <div class="main">
        <h1>{{ title }}</h1>
        <div>
            <router-link :to="{name: 'typeList'}">list</router-link>
            <router-link :to="{name: 'typeAdd'}">add</router-link>
        </div>
        <router-view></router-view>
    </div>
</template>
<script>
export default {
  name: 'type',
  computed: {
    title() {
      return this.$route.params.type;
    },
  },
};
</script>
