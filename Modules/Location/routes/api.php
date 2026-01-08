<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controllers\LocationController;

Route::prefix('v1')->group(function () {
    Route::apiResource('locations', LocationController::class)->names('locations');
    Route::apiResource('location-types', \Modules\Location\Http\Controllers\LocationTypeController::class)->names('location-types');
});
