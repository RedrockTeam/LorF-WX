<?php

namespace App\Modules\LAF\Providers;

use Caffeinated\Modules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	/**
	 * The controller namespace for the module.
	 *
	 * @var string|null
	 */
	protected $namespace = 'App\Modules\LAF\Http\Controllers';

	/**
	 * Define your module's route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);

		// 导入中间件
		$router->middleware('laf.weixin', \App\Modules\LAF\Http\Middleware\WeixinAuthenticate::class);
	}

	/**
	 * Define the routes for the module.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group([
			'namespace'  => $this->namespace,
			'middleware' => ['web']
		], function($router) {
			require (config('modules.path').'/LAF/Http/routes.php');
		});
	}
}
