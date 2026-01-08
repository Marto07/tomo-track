<?php

use Illuminate\Support\Facades\Route;
use Modules\Tool\Http\Controllers\ToolController;
use Modules\Tool\Http\Controllers\CategoryController;
use Modules\Tool\Http\Controllers\MovementTypeController;

Route::prefix('v1')->group(function () {
    Route::apiResource('tools', ToolController::class)->names('tools');
    Route::apiResource('categories', CategoryController::class)->names('categories');
    Route::apiResource('movement-types', MovementTypeController::class)->names('movement-type');
    Route::apiResource('tool-movements', \Modules\Tool\Http\Controllers\ToolMovementController::class)->names('tool-movements');
});
