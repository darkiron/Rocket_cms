import Vue from 'vue';
import Vuex from 'vuex';
import { fetchEndpoints } from './api'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentEndpoint: {},
    endpoints: [],
    loading: true,
  },
  mutations: {
    setLoading (state, status) {
      state.loading = status
    },
    setCurrentEndpoint (state, endpoint) {
      state.currentEndpoint = endpoint;
    },
    setEndpoints (state, endpoints) {
      state.endpoints = endpoints
    }
  },
  actions: {
    setLoading ({ commit }, status) {
      commit('setLoading', status)
    },
    initEndpoints ({ commit, dispatch }) {
      dispatch('setLoading', true)
      return fetchEndpoints().then(r => {
        commit('setEndpoints', r)
      })
    },
    setCurrentEndpoint ({ commit }, endpoint){
      commit('setCurrentEndpoint', endpoint)
    },
    setEndpoints ({ commit }, endpoints){
      commit('setEndpoints', endpoints)
    },
    findEndpoints({ state }, search) {
      console.log(state.endpoints)
      return state.endpoints.filter(i => {
        if (Object.values(i).find(e => {
          return e.indexOf(search) >= 0
        })) return i
      })
    }
  }
})
