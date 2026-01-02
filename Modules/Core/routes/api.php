<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CityController;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\CountryController;
use Modules\Core\Http\Controllers\StateController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('cores', CoreController::class)->names('core');
});
Route::apiResource('countries', CountryController::class)->names('countries');
Route::apiResource('states', StateController::class)->names('states');
Route::apiResource('cities', CityController::class)->names('cities');