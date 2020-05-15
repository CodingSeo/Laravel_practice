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
// Route::get('/', [
// 	'as'=>'home',
// 	'WelcomeController@index'
// 	]
// );
Route::get('/', 'WelcomeController@index');
// Route::get('/', [
// 	'as'=>'home',
// 	function () {
// 		return view('welcome');
// 	}]
// );

Route::resource('articles', 'ArticlesController');

Route::get('auth/login', function(){
	$credentials=[
		'email' =>'test@test.com',
		'password' => '1234'
	];
	if(!auth()->attempt($credentials)){
		return 'login info error';
	}
	return redirect('protected');
});

// Route::get('protected',function(){
// 	dump(session()->all());
// 	if(!auth()->check()){
// 		return 'who are you?';
// 	}
// 	return 'welcome '. auth()->user()->name;
// });
Route::get('protected',['middleware'=>'auth',function(){
	dump(session()->all());
	return 'welcome '. auth()->user()->name;
}]);

Route::get('auth/logout',function(){
	auth()->logout();
	return 'see ya';
});


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/reset','Auth\ForgotPasswordController@showLinkRequestForm');
