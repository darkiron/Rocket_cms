import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentEndpoint: {},
  },
  mutations: {
    setCurrentEndpoint(state, endpoint) {
      state.currentEndpoint = endpoint;
    },
  },
  actions: {
    setCurrentEndpoint({ commit }, endpoint){
      commit('setCurrentEndpoint', endpoint)
    }
  },
});
