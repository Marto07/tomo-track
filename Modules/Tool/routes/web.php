<?php

use Illuminate\Support\Facades\Route;
use Modules\Tool\Http\Controllers\ToolController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tools', ToolController::class)->names('tool');
});
