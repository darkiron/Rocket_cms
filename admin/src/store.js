import Vue from 'vue';
import Vuex from 'vuex';
import { fetchEndpoints } from './api'

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    currentEndpoint: {},
    endpoints: [],
    loading: true,
    running: false,
    user: {
      username: 'John Doe',
      token: '',
      avatar: 'https://picsum.photos/50/50'
    }
  },
  mutations: {
    setLoading (state, status) {
      state.loading = status
    },
    setCurrentEndpoint (state, endpoint) {
      state.currentEndpoint = endpoint;
    },
    setEndpoints (state, endpoints) {
      endpoints.forEach((item, key) => {
        Vue.set(state.endpoints, key, item )
      })
      //state.endpoints = endpoints
    },
    setRunning (state, func){
      state.running = func
    }
  },
  actions: {
    initEndpoints ({ commit, state }) {
      if (!state.running){
        commit('setRunning', 'initEndpoints')
        return fetchEndpoints().then(r => {
          commit('setEndpoints', r)
          commit('setRunning', false)
        })
      }
    },
    searchEndPoint ({ state }, { type, rName }) {
      const roadSearch = `api_${(rName === 'typeAdd')? 'crud_' : '' }${type}${(rName === 'typeAdd')? '_add' : '' }`
      return state.endpoints.filter(i => {
        // if (i.name.indexOf(roadSearch) === 0 ) {
        if (i.name === roadSearch ) {
          return i
        }
      })
    },
    setCurrentEndpoint ({ commit }, endpoint) {
      return commit('setCurrentEndpoint', endpoint)
    },
    setLoading({ commit }, value){
      return commit('setLoading', value)
    }
  }
})
