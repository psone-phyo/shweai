<?php

use Modules\Merchant\Http\Controllers\MerchantController;

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\Merchant\Http\Controllers'], function()
{
    		/*
             * For DataTables
             */
            Route::post('merchant/get', 'MerchantTableController')->name('merchant.get');
            /*
             * User CRUD
             */
            Route::get('merchant/suspended-list', [MerchantController::class, 'suspendedList'])->name('merchant.suspended_list');
            Route::get('merchant/rejected-list', [MerchantController::class, 'rejectedList'])->name('merchant.rejected_list');
            Route::get('merchant/pending-list', [MerchantController::class, 'pendingList'])->name('merchant.pending_list');

            Route::get('merchant/{merchant}/suspend', [MerchantController::class, 'suspend'])->name('merchant.suspend');
            Route::get('merchant/{merchant}/reject', [MerchantController::class, 'reject'])->name('merchant.reject');

            Route::resource('merchant', 'MerchantController');
});