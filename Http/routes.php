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

    Route::group(['prefix' => 'api', 'middleware' => 'laf.mobile'], function () {
        Route::get('/view/{theme}/{category?}/{page?}', 'CoreController@view');
        Route::get('/detail/{product}', function (Request $request, $product) {
            return response()->json((new \App\Modules\LAF\Models\ProductList())->getDetailByProductId($product), 200);
        })->where('product', '\d+');
        Route::post('/create', 'CoreController@create');
    });

	Route::get('/view/{theme}/{category?}/{page?}', 'CoreController@view');
	Route::get('/detail/{product}', 'CoreController@detail')->where('product', '\d+');
	Route::post('/create', 'CoreController@create');
});

Route::group(['prefix' => 'lostandfound', 'middleware' => 'laf.weixin'], function() {
	Route::get('/lost', function () { return view('LAF::lost'); });
	Route::get('/issue', function () { return view('LAF::issue'); });
	Route::get('/found', function () { return view('LAF::found'); });
});
