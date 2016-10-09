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

Route::group(['prefix' => 'laf'], function() {
	Route::get('/view/{theme}/{category?}/{page?}', 'CoreController@view');
	Route::get('/detail/{product}', 'CoreController@detail')->where('product', '\d+');
	Route::post('/create', 'CoreController@create');
});

Route::group(['prefix' => 'lostandfound', 'middleware' => 'laf.weixin'], function() {
	Route::get('/lost', function () { return view('laf::lost'); });
	Route::get('/issue', function () { return view('laf::issue'); });
	Route::post('/found', function () { return view('laf::found'); });
});
