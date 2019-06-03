<?php

Route::group(['middleware' => 'web'], function () {

Route::auth();

Route::get('/home', 'HomeController@index');

});

Route::post('sendmessage', 'chatController@sendMessage');

?>
