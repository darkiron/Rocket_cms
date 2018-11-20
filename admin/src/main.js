import Vue from 'vue';
import App from './App.vue';
import router from './router';
import store from './store';

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
  next(vm => {
    // access to component instance via `vm`
    console.log(vm);
    vm.$forceUpdate();
  });
});

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app');
