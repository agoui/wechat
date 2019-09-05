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

Route::get('/', function () {
    return view('welcome');
});
//

/////
///
/// 登录
///
Route::get('/login','LoginController@login');

Route::get('/wechat/login','LoginController@wechat_login');
Route::get('/wechat/code','LoginController@code');

///////
///
///
///
///
///
Route::get('wechat/get_access_token','WechatController@get_access_token'); //获取access_token
Route::get('/wechat/get_user_list','WechatController@get_user_list'); //获取用户列表
Route::get('/wechat/get_wechat_access_token','WechatController@get_wechat_access_token');
Route::get('/wechat/get_detailed_info','WechatController@get_detailed_info');