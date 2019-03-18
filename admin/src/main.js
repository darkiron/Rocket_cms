import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import loadMixin from './mixins/load'

Vue.config.productionTip = false

Vue.mixin(loadMixin)

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app');
