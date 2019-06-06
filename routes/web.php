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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profil', 'HomeController@showProfilPage')->name('profil');

Route::post('sendmessage', 'chatController@sendMessage');

//Friends routes
Route::post('addFriend', 'FriendsController@addFriend');
Route::post('deleteFriend', 'FriendsController@deleteFriend');
Route::get('listFriends', 'FriendsController@getFriendList');

//Users
Route::get('listUsers', 'UserController@listUsers');

Route::get('/test', function () {
    Redis::publish('test-channel', 'ceci est un test');
});
