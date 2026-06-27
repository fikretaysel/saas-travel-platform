<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AgencyController;

Route::apiResource('agencies', AgencyController::class);
