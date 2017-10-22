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
    return redirect('/home');
});

//后台
Route::get('/admin/index', 'Admin\IndexController@index');
Route::get('/admin/login', 'Admin\IndexController@login');
Route::any('/admin/loginRes', 'Admin\IndexController@loginRes');
Route::any('/admin/loginout', 'Admin\IndexController@loginout');

Route::any('/settingApi/{type}', 'Admin\SettingController@settingApi');
Route::any('/apiAddXiaoyou', 'Admin\XiaoweihuiController@apiAddXiaoyou');
//获取校友会列表
Route::any('/apiXiaoyouList', 'Admin\XiaoweihuiController@apiXiaoyouList');
//通过校友灰id 获取校友会详情
Route::any('/apiXiaoyouhuiDetail/{id}', 'Admin\XiaoweihuiController@getDetailById');
//通过校友会id  返回通讯录
Route::any('/apiXiaoyouDetail', 'Admin\XiaoweihuiController@apiXiaoyouDetail');

Route::any('/apiSchool', 'Admin\SchoolController@apiSchool');
Route::any('/apiAddUser', 'Admin\UserController@apiAddUser');
//编辑名片
Route::any('/apiEditUser', 'Admin\UserController@apiEditUser');
//通过openid 拿到userinfo
Route::any('/apiUserInfo', 'Admin\UserController@apiUserInfo');
//添加活动
Route::any('/apiAddActivity', 'Admin\ActivityController@apiAddActivity');

Route::any('/apiCheckLogin/{code}','ApiController@checkLogin');


Route::group(['as' => 'setting','middleware' => ['checklogin']], function () {
    Route::any('/admin/setting/{type}', 'Admin\SettingController@index');

    Route::any('/admin/addSettingRes', 'Admin\SettingController@addSettingRes');
    Route::any('/admin/deleteSetting/{id}/{type}', 'Admin\SettingController@deleteSetting');
});

Route::group(['as' => 'school','middleware' => ['checklogin']], function () {
    Route::any('/admin/school', 'Admin\SchoolController@index');
    Route::any('/admin/addSchool', 'Admin\SchoolController@addSchool');
    Route::any('/admin/addSchoolRes', 'Admin\SchoolController@addSchoolRes');
    Route::any('/admin/editSchool/{id}', 'Admin\SchoolController@editSchool');
    Route::any('/admin/editSchoolRes', 'Admin\SchoolController@editSchoolRes');
    Route::any('/admin/deleteSchool/{id}', 'Admin\SchoolController@deleteSchool');
});

Route::group(['as' => 'xiaoweihui','middleware' => ['checklogin']], function () {
    Route::any('/admin/xiaoweihui', 'Admin\XiaoweihuiController@index');

});

Route::group(['as' => 'user','middleware' => ['checklogin']], function () {
    Route::any('/admin/user', 'Admin\UserController@index');
    Route::any('/admin/user/userdetail/{id}', 'Admin\UserController@userdetail');
});

Route::group(['as' => 'activity','middleware' => ['checklogin']], function () {
    Route::any('/admin/activity', 'Admin\ActivityController@index');
});






