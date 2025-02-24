<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('pages/{any}', [PageController::class, 'resolvePage'])->where('any', '.*');
Route::apiResource('pages', PageController::class);
