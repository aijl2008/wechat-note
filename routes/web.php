<?php
use Illuminate\Support\Facades\Route;

/**
 * 微信消息接口
 */
Route::group ( [
    'namespace' => 'Awz\Note\Http\Controllers' ,
] , function () {
    Route::get ( 'api' , 'WechatController@api' );
    Route::post ( 'api' , 'WechatController@api' );
} );
/**
 * 其他页面,需要web中间价
 */
Route::group ( [
    'namespace' => 'Awz\Note\Http\Controllers' ,
    'middleware' => [ 'web' ]
] , function () {
    Route::get ( '/test' , function () {
        dump ( \Illuminate\Support\Facades\Auth::check () );
    } );
    /**
     * 覆写auth的home路由
     */
    Route::get ( '/home' , 'NotesController@index' );
    /**
     * 首页
     */
    Route::get ( '/' , 'NotesController@index' );
    /**
     * 记事模块
     */
    Route::group ( [
        'prefix' => 'notes' ,
    ] , function () {
        Route::get ( '/' , 'NotesController@index' )->name ( 'notes.note.index' );
        Route::get ( '/create' , 'NotesController@create' )->name ( 'notes.note.create' );
        Route::get ( '/{note}/edit' , 'NotesController@edit' )->name ( 'notes.note.edit' )->where ( 'id' , '[0-9]+' );
        Route::post ( '/' , 'NotesController@store' )->name ( 'notes.note.store' );
        Route::put ( 'note/{note}' , 'NotesController@update' )->name ( 'notes.note.update' )->where ( 'id' , '[0-9]+' );
        Route::delete ( '/note/{note}' , 'NotesController@destroy' )->name ( 'notes.note.destroy' )->where ( 'id' , '[0-9]+' );
    } );
    /**
     * 系统设置模块
     */
    Route::group ( [
        'prefix' => 'settings' ,
    ] , function () {
        Route::get ( 'edit' , 'SettingsController@edit' )->name ( 'settings.setting.edit' );
        Route::put ( 'setting' , 'SettingsController@update' )->name ( 'settings.setting.update' );
    } );
    /**
     * 图片
     */
    Route::group ( [
        'prefix' => 'image' ,
    ] , function () {
        Route::get ( '{model}/{id}' , 'ImageController@image' );
    } );
} );