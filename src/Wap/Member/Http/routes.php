<?php

Route::get('/wechatStore', 'AuthorizationsController@wechatStore')->middleware('wechat-oauth');
Route::get('/index', 'AuthorizationsController@index')->name('wap.member.index');

