<?php

Route::group(['prefix' => 'v1','middleware' => 'auth:api'], function () {
    Route::post('/group', 'APIGroupController@store');

    Route::post('/group/{group}/user/{user}', 'APIUserGroupController@store');
});
