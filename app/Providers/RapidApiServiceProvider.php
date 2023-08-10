<?php

namespace App\Providers;

use App\Services\RapidApiSevice;
use Illuminate\Support\ServiceProvider;

class RapidApiServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			RapidApiSevice::class,
			fn() => new RapidApiSevice(config('app.rapid_api_key'))
		);
	}

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}
}
