import request from '@/utils/request'

export function login(name, password) {
  console.log(name)
  return request({
    url: '/login/login',
    method: 'post',
    data: {
      name,
      password
    }
  })
}

export function getInfo(token) {
  return request({
    url: '/login/info',
    method: 'get',
    params: { token }
  })
}

export function logout() {
  return request({
    url: '/login/logout',
    method: 'post'
  })
}
