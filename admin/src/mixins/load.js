export default {
  methods: {
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
  computed: {
    loading () {
      if (this.$store !== undefined)
        return this.$store.state.loading
      else
        return true
    },
    currentEndpoint () {
      return this.$store.state.currentEndpoint
    }
  },
  watch: {
    $route () {
      this.current()
    },
    loading() {
      if (this.loading){
        document.getElementById('loader').style.opacity = 1
      } else {
        document.getElementById('loader').style.opacity = 0
      }
    }
  },
  beforeMount () {
    if (!this.$store.state.endpoints.length) {
      this.$store.dispatch('initEndpoints', this.$route).then(() => {
        this.current().then(() => {
          this.$store.dispatch('setLoading', false)
        })
      })
    }
  },
}
