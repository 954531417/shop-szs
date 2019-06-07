import Vue from 'vue'
import Router from 'vue-router'

// in development-env not use lazy-loading, because lazy-loading too many pages will cause webpack hot update too slow. so only in production use lazy-loading;
// detail: https://panjiachen.github.io/vue-element-admin-site/#/lazy-loading

Vue.use(Router)

/* Layout */
import Layout from '../views/layout/Layout'

/**
* hidden: true                   if `hidden:true` will not show in the sidebar(default is false)
* alwaysShow: true               if set true, will always show the root menu, whatever its child routes length
*                                if not set alwaysShow, only more than one route under the children
*                                it will becomes nested mode, otherwise not show the root menu
* redirect: noredirect           if `redirect:noredirect` will no redirct in the breadcrumb
* name:'router-name'             the name is used by <keep-alive> (must set!!!)
* meta : {
    title: 'title'               the name show in submenu and breadcrumb (recommend set)
    icon: 'svg-name'             the icon show in the sidebar,
  }
**/
export const constantRouterMap = [
  { path: '/login', component: () => import('@/views/login/index'), hidden: true },
  { path: '/404', component: () => import('@/views/404'), hidden: true },

  {
    path: '/',
    component: Layout,
    redirect: '/dashboard',
    name: 'Dashboard',
    hidden: true,
    children: [{
      path: 'dashboard',
      component: () => import('@/views/dashboard/index')
    }]
  },
  {
    path: '/system',
    component: Layout,
    redirect: '/system/Admin',
    name: 'system',
    meta: { title: '系统管理', icon: 'example' },
    children: [
      {
        path: 'Admin',
        name: 'Admin',
        component: () => import('@/views/admin/index'),
        meta: { title: '管理员列表', icon: 'table' }
      },
      {
        path: 'Roles',
        name: 'Roles',
        component: () => import('@/views/roles/index'),
        meta: { title: '角色列表', icon: 'tree' }
      },
      {
        path: 'Privilege',
        name: 'Privilege',
        component: () => import('@/views/Privilege/index'),
        meta: { title: '权限列表', icon: 'tree' }
      }
    ]
  },
  {
    path: '/shop',
    component: Layout,
    redirect: '/shop/goods',
    name: 'goods',
    meta: { title: '商品管理', icon: 'example' },
    children: [
      {
        path: 'Goods',
        name: 'Goods',
        component: () => import('@/views/Goods/add'),
        meta: { title: '商品添加', icon: 'tree' }
      },
      {
        path: 'Goods/list',
        name: 'Goods/list',
        component: () => import('@/views/Goods/list'),
        meta: { title: '商品列表', icon: 'tree' },
      },
      { 
        path: 'Goods/edit',
        name: 'Goods/edit',
        component: () => import('@/views/Goods/edit'),
        meta: { title: '商品修改'},
        hidden: true },
      {
        path: 'Category',
        name: 'Category',
        component: () => import('@/views/Category/index'),
        meta: { title: '分类列表', icon: 'tree' }
      },
      {
        path: 'Attribute',
        name: 'Attribute',
        component: () => import('@/views/Attribute/index'),
        meta: { title: '类型列表', icon: 'tree' }
      }
    ]

  },
  {
    path: '/News',
    component: Layout,
    name: 'News',
    meta: { title: '新闻管理', icon: 'example' },
    children: [
      {
        path: 'index',
        name: 'News',
        component: () => import('@/views/News/index'),
        meta: { title: '新闻添加', icon: 'form' }
      },
      {
        path: 'list',
        name: 'News/list',
        component: () => import('@/views/News/list'),
        meta: { title: '新闻列表', icon: 'form' }
      },
      {
        path: 'News/edit',
        name: 'News/edit',
        component: () => import('@/views/News/edit'),
        meta: { title: '新闻修改'},
        hidden: true
      }
    ]
  },

  { path: '*', redirect: '/404', hidden: true }
]

export default new Router({
  // mode: 'history', //后端支持可开
  scrollBehavior: () => ({ y: 0 }),
  routes: constantRouterMap
})

