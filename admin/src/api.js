import axios from 'axios'

export function fetchEndpoints () {
  return new Promise(res => {
    axios.get(`http://localhost:8888/api`).then(r => {
      res(r.data)
    })
  })
}
