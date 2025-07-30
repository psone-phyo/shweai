<?php

namespace App\Providers;

use GMBF\MyanmarPhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider.
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        Paginator::useBootstrap();

        $this->customValidator($request);

    }

    public function customValidator($request)
    {
        $this->app['validator']->extend('valid_phone_number', function ($attribute, $value, $parameters) use ($request) {
            $phone_number = new MyanmarPhoneNumber();
            if ($phone_number->is_valid($value)) {
                return true;
            }
            return false;
        });
    }
}
