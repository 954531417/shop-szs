import request from '@/utils/request'

export function edit(params, url) {
  return request({
    url: url,
    method: 'post',
    params
  })
}
export function getList(params, url) {
  return request({
    url: url,
    method: 'get',
    params
  })
}
export function add(params, url) {
  return request({
    url: url,
    method: 'post',
    params
  })
}
export function del(params, url) {
  return request({
    url: url,
    method: 'post',
    params
  })
}
export function GAPI(params, url) {
  return request({
    url: url,
    method: 'get',
    params
  })
}
export function PAPI(params, url) {
  return request({
    url: url,
    method: 'post',
    params
  })
}
