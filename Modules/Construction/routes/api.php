<?php

use Illuminate\Support\Facades\Route;
use Modules\Construction\Http\Controllers\ConstructionAddressController;
use Modules\Construction\Http\Controllers\ConstructionController;
use Modules\Construction\Http\Controllers\ConstructionTypeController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
});
Route::apiResource('constructions.addresses', ConstructionAddressController::class)->names('constructions.addresses');
Route::apiResource('constructions', ConstructionController::class)->names('constructions');
Route::apiResource('construction-types', ConstructionTypeController::class)->names('construction-types');

