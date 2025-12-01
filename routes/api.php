<?php

use App\Http\Controllers\TrabajoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('trabajos', TrabajoController::class);
