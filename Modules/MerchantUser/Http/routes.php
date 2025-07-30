<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\MerchantUser\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('merchantuser/get', 'MerchantUserTableController')->name('merchantuser.get');
            /*
             * User CRUD
             */
            Route::resource('merchantuser', 'MerchantUserController');
});