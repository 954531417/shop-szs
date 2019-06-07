'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  // BASE_API: '"www.szxzsyx.com"',
  BASE_API: '"127.0.0.1:8000"',
})
