<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Home\IndexController@index');
Route::get('/detailsPage', 'Home\IndexController@DetailsPage');//详情页
Route::get('/contactUs', 'Home\IndexController@ContactUs');//公司简介
Route::get('/productDisplay', 'Home\IndexController@ProductDisplay');//产品列表
Route::get('/NewsInformation', 'Home\IndexController@NewsInformation');//产品列表
Route::get('/MessageBoard', 'Home\IndexController@MessageBoard');//产品列表
Route::get('/AboutUs', 'Home\IndexController@AboutUs');//产品列表
Route::get('/NewsInformationDetails', 'Home\IndexController@NewsInformationDetails');//产品列表

Route::post('/push', 'Home\IndexController@push');

Route::get('/search', 'Home\IndexController@search');
Route::get('/getSearch', 'Home\IndexController@getSearch');







Route::post('login/login', 'Admin\LoginController@login');

Route::get('/login/info', 'Admin\LoginController@info');

Route::post('/login/logout', 'Admin\LoginController@logout');

Route::get('/admin/list', 'Admin\AdminController@list');
Route::post('/admin/add', 'Admin\AdminController@add');
Route::post('/admin/edit', 'Admin\AdminController@edit');
Route::post('/admin/softDel', 'Admin\AdminController@softDel');
Route::post('/admin/recover', 'Admin\AdminController@recover');
Route::post('/admin/remove', 'Admin\AdminController@remove');


Route::get('/privilege/list',       'Admin\PrivilegeController@list');
Route::post('/privilege/add',       'Admin\PrivilegeController@add');
Route::post('/privilege/edit',      'Admin\PrivilegeController@edit');
Route::post('/privilege/softDel',   'Admin\PrivilegeController@softDel');
Route::post('/privilege/recover',   'Admin\PrivilegeController@recover');
Route::post('/privilege/remove',    'Admin\PrivilegeController@remove');
Route::get('/privilege/getparent',    'Admin\PrivilegeController@getParent');

Route::get('/roles/list',       'Admin\RolesController@list');
Route::post('/roles/add',       'Admin\RolesController@add');
Route::post('/roles/edit',      'Admin\RolesController@edit');
Route::post('/roles/softDel',   'Admin\RolesController@softDel');
Route::post('/roles/recover',   'Admin\RolesController@recover');
Route::post('/roles/remove',    'Admin\RolesController@remove');
Route::get('/roles/getrole',    'Admin\RolesController@getRole');

Route::get('/brand/list',       'Admin\BrandController@list');
Route::post('/brand/add',       'Admin\BrandController@add');
Route::post('/brand/edit',      'Admin\BrandController@edit');
Route::post('/brand/softDel',   'Admin\BrandController@softDel');
Route::post('/brand/recover',   'Admin\BrandController@recover');
Route::post('/brand/remove',    'Admin\BrandController@remove');
Route::post('/brand/upload',    'Admin\BrandController@upload');
Route::get('/brand/getrole',    'Admin\BrandController@getRole');

Route::get('/news/list',       'Admin\NewsController@list');
Route::post('/news/add',       'Admin\NewsController@add');
Route::post('/news/edit',      'Admin\NewsController@edit');
Route::post('/news/softDel',   'Admin\NewsController@softDel');
Route::post('/news/recover',   'Admin\NewsController@recover');
Route::post('/news/remove',    'Admin\NewsController@remove');
Route::post('/news/upload',    'Admin\NewsController@upload');
Route::get('/news/getrole',    'Admin\NewsController@getRole');
Route::get('/news/editCon',    'Admin\NewsController@editCon');

Route::get('/category/list',       'Admin\CategoryController@list');
Route::post('/category/add',       'Admin\CategoryController@add');
Route::post('/category/edit',      'Admin\CategoryController@edit');
Route::post('/category/softDel',   'Admin\CategoryController@softDel');
Route::post('/category/recover',   'Admin\CategoryController@recover');
Route::post('/category/remove',    'Admin\CategoryController@remove');
Route::get('/category/getCategory',    'Admin\CategoryController@getCategory');
Route::post('/category/upload',    'Admin\CategoryController@upload');

Route::get('/attribute/list',       'Admin\AttributeController@list');
Route::post('/attribute/add',       'Admin\AttributeController@add');
Route::post('/attribute/edit',      'Admin\AttributeController@edit');
Route::post('/attribute/softDel',   'Admin\AttributeController@softDel');
Route::post('/attribute/recover',   'Admin\AttributeController@recover');
Route::post('/attribute/remove',    'Admin\AttributeController@remove');
//Route::get('/Attribute/getCategory',    'Admin\AttributeController@getCategory');

Route::post('/goods/upload',    'Admin\GoodsController@upload');
Route::get('/goods/list',       'Admin\GoodsController@list');
Route::post('/goods/add',       'Admin\GoodsController@add');
Route::post('/goods/edit',      'Admin\GoodsController@edit');
Route::post('/goods/softDel',   'Admin\GoodsController@softDel');
Route::post('/goods/recover',   'Admin\GoodsController@recover');
Route::post('/goods/remove',    'Admin\GoodsController@remove');
//Route::get('/Attribute/getCategory',    'Admin\AttributeController@getCategory');
Route::post('/goods/upload',    'Admin\GoodsController@upload');
Route::get('/goods/init',    'Admin\GoodsController@addInit');



