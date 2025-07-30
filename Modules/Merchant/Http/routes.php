<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Merchant\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('merchant/get', 'MerchantTableController')->name('merchant.get');
            /*
             * User CRUD
             */
            Route::resource('merchant', 'MerchantController');
});