<?php

Route::group(['middleware' => ['web','admin'], 'as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Modules\AppSetting\Http\Controllers'], function()
{
    Route::resource('appsetting', 'AppSettingController');
});