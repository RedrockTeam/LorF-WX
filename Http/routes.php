<?php

/*
|--------------------------------------------------------------------------
| Module Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for the module.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(['prefix' => 'laf', 'middleware' => 'laf.weixin'], function() {
	Route::get('/view/{theme}/{category?}/{page?}', 'CoreController@view');
	Route::get('/detail/{product}', 'CoreController@detail')->where('product', '\d+');
	Route::post('/create', 'CoreController@create');
});
