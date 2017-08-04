<?php
    Route::group(['middleware' => ['web']], function () {
        Route::post('/SSRelay/action/create/{id}','Tchoblond59\SSRelay\Controllers\SSRelayController@store');
        Route::post('/SSRelay/action/toggle','Tchoblond59\SSRelay\Controllers\SSRelayController@toggle');
        Route::get('/SSRelay/update/{id}','Tchoblond59\SSRelay\Controllers\SSRelayController@update')->middleware('role:tech,update sensor');
        Route::post('/SSRelay/update/{id}','Tchoblond59\SSRelay\Controllers\SSRelayController@upgrade');

        Route::get('/widget/SSRelay/{id}', 'Tchoblond59\SSRelay\Controllers\SSRelayController@configureWidget');
});