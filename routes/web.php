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

Route::get('/', 'MicropostsController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showregistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () { //ログインしていないとつかえないぞって意味合い
    Route::group(['prefix' => 'users/{id}'], function () {
    Route::post('follow', 'UserFollowController@store')->name('user.follow');
    Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
    Route::get('followings', 'UsersController@followings')->name('users.followings');
    Route::get('followers', 'UsersController@followers')->name('users.followers');
    });
    // ユーザ一覧とユーザ詳細のみ
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);

    // 登録と削除のみ
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});

