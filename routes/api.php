<?php

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    Route::get('/group',            'APIGroupController@index');
    Route::get('/group/{group}',    'APIGroupController@show');
    Route::post('/group',           'APIGroupController@store');
    Route::put('/group/{group}',    'APIGroupController@update');
    Route::delete('/group/{group}', 'APIGroupController@destroy');

    Route::post('/group/{group}/user/{user}', 'APIUserGroupController@store');

});
