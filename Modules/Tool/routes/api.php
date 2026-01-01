<?php

use Illuminate\Support\Facades\Route;
use Modules\Tool\Http\Controllers\ToolController;
use Modules\Tool\Http\Controllers\CategoryController;

Route::prefix('v1')->group(function () {
    Route::apiResource('tools', ToolController::class)->names('tool');
    Route::apiResource('categories', CategoryController::class)->names('category');
});
