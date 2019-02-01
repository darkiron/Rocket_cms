import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
  next(vm => {
    // access to component instance via `vm`
    console.log(vm)
    console.log('toast', vm.$store)
    vm.$forceUpdate()
  })
})

new Vue({
  router,
  store,
  render: h => h(App),
  watch: {
    $route:  function() {
      this.$store.dispatch('setLoading', true)
      this.$store.dispatch('findEndpoints', this.$route.path.split('/').join('_')).then(() => {
        this.$store.dispatch('setLoading', false)
      })
    }
  },
  created() {
    this.$store.dispatch('initEndpoints').then(() => {
      this.$store.dispatch('setLoading', false)
    })
  },
}).$mount('#app');
