<?php

Route::group(array('prefix' => 'api'), function(){
	Route::resource('posts', 'PostsController');
});

Route::get('admin', function(){
	if(Auth::check())
	{
		return View::make('admin.index');
	}
	else
	{
		return View::make('admin.login');
	}
});

Route::post('login', function(){
	Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true);
	return Redirect::to('/admin');
});

Route::get('logout', function(){
	Auth::logout();
	return Redirect::to('/admin');
});

Route::controller('/', 'HomeController');