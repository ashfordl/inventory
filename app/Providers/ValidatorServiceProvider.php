<?php namespace Inventory\Providers;

// use Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app['validator']->extend('valueOrExists', function($attribute, $value, $parameters)
        {
            // True if the value is equal to the given parameter
            $val = ($value == $parameters[0]);

            if ($val == true)
            {
                // Avoid the database query if possible
                return true;
            }

            // The column in the database to look up
            $col = isset($parameters[2]) ? $parameters[2] : $attribute;

            // True if the value is present in the database
            $exists = null !== \DB::table($parameters[1])->where($col, $value)->first();

            return $exists;
        });
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{

	}

}
