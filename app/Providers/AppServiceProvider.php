<?php

namespace App\Providers;

use GMBF\MyanmarPhoneNumber;
use Illuminate\Http\Request;
use App\Domains\Auth\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Modules\Merchant\Entities\Merchant;

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


        $this->app['validator']->extend('unique_user_phone_number', function ($attribute, $value, $parameters) {
            $phone_number = new MyanmarPhoneNumber();
            $value = $phone_number->add_prefix($value);

            $ignoreId = isset($parameters[0]) ? $parameters[0] : null;

            $count = 0;

            $count += User::where('mobile', $value)
                ->when($ignoreId, function ($q) use ($ignoreId) {
                    $q->where('id', '!=', $ignoreId);
                })
                ->count();

            return $count == 0;
        });

        $this->app['validator']->extend('unique_merchant_phone_number', function ($attribute, $value, $parameters) {
            $phone_number = new MyanmarPhoneNumber();
            $value = $phone_number->add_prefix($value);

            $ignoreId = isset($parameters[0]) ? $parameters[0] : null;

            $count = 0;

            $count += Merchant::where('business_mobile', $value)
                ->when($ignoreId, function ($q) use ($ignoreId) {
                    $q->where('id', '!=', $ignoreId);
                })
                ->count();

            return $count == 0;
        });
    }
}
