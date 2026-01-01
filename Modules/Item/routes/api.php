<?php

use Illuminate\Support\Facades\Route;
use Modules\Item\Http\Controllers\CategoryController;
use Modules\Item\Http\Controllers\ItemController;

// Route::apiResource('items', ItemController::class)->names('item');
// Route::apiResource('categories', CategoryController::class)->names('category');

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
});
