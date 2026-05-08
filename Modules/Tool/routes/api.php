<?php

use Illuminate\Support\Facades\Route;
use Modules\Tool\Http\Controllers\ToolController;
use Modules\Tool\Http\Controllers\CategoryController;
use Modules\Tool\Http\Controllers\MovementTypeController;
use Modules\Tool\Http\Controllers\ToolMovementController;

Route::middleware(['auth:sanctum', 'verified'])->prefix('v1')->group(function () {
    Route::apiResource('tools', ToolController::class)->names('tools');
    Route::apiResource('categories', CategoryController::class)->names('categories');
    Route::apiResource('movement-types', MovementTypeController::class)->names('movement-type');
    Route::post('tools/add-stock', [ToolMovementController::class, 'addStock'])->name('tools.add-stock');
    Route::post('tools/transfer', [ToolMovementController::class, 'transfer'])->name('tools.transfer');
});
