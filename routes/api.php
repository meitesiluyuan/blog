<?php

$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api) {

    $api->group(['namespace'=>'App\Api\Controllers','prefix'=>'admin'],function ($api){
        //会员登录
        $api->post('login','AuthController@login');
        $api->post('avatar','UserController@avatar');
        $api->get('userInfo','AuthController@userInfo');
        //会员注册
        $api->post('register','AuthController@register');

        $api->group(['middleware'=>'jwt.auth'],function ($api){


        });
        //会员列表
        $api->resource('user','UserController');
        //会员组列表
        $api->resource('user_group','UserGroupController');
        $api->get('getAllUserGroup','UserGroupController@getAllUserGroup');
        $api->get('region','RegionController@index');


    });
});
