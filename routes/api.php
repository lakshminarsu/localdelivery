<?php

Route::group(['prefix' => 'v1'], function() {


	Route::resource('xyz/registration', 'registrationController', [
		'except' => ['edit', 'create']
	]);

	Route::resource('xyz/usercustomer', 'UserCustController', [
		'except' => ['edit', 'create']
	]);

	Route::resource('xyz/userdriver', 'UserDriverController', [
		'except' => ['edit', 'create']
	]);

	Route::resource('xyz/booking', 'BookingController', [
		'except' => ['edit', 'create']
	]);

	Route::resource('xyz/order', 'OrderController', [
		'except' => ['edit', 'create']
	]);

	Route::resource('xyz/branchlocation', 'BranchLocController', [
		'except' => ['edit', 'create']
	]);	

	Route::post('xyz/orderupdate',[
		'uses' => 'OrderController@updateOrder'
	]);

	Route::get('xyz/branchorders',[
		'uses' => 'OrderController@getBranchOrders'
	]);

	Route::get('xyz/deliverers',[
		'uses' => 'OrderController@getdeliverers'
	]);	

	Route::get('xyz/delivererorders',[
		'uses' => 'OrderController@getdelivererorders'
	]);		

	Route::get('xyz/drivers',[
		'uses' => 'UserDriverController@getDrivers'
	]);	

	Route::post('xyz/user',[
		'uses' => 'AuthController@store'
	]);

	Route::post('xyz/signin',[
		'uses' => 'AuthController@signin'
	]);	
});
