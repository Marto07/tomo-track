<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\Http\Controllers\LocationController;

Route::apiResource('locations', LocationController::class)->names('location');
Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
});
