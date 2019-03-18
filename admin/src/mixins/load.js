export default {
  methods: {
    load () {
      return this.$store.dispatch('initEndpoints', this.$route)
    },
    current () {
      return new Promise((resolve, reject) => {
        if (this.$store.state.endpoints.length) {
          resolve(
            this.$store.dispatch('searchEndPoint', { 'type': this.$route.params.type, 'rName': this.$route.name }).then(r => {
              if (r.length >= 1) {
                this.$store.dispatch('setCurrentEndpoint', r[0])
              }
            })
          )
        }
        // reject('error')
      })
    }
  },
  watch: {
    $route () {
      this.current()
    }
  },
  beforeMount () {
    if (!this.$store.state.endpoints.length) {
      this.load().then (() => {
        this.current().then(() => {
          this.$store.dispatch('setLoading', false)
        })
      })
    }
  },
}
