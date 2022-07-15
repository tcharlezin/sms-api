<?php

use Illuminate\Support\Facades\Route;

Route::post('/sms', [\App\Http\Controllers\SMSController::class, 'store']);
Route::get('/sms/{uuid}', [\App\Http\Controllers\SMSController::class, 'view']);
Route::post('/sms-receive', [\App\Http\Controllers\SMSController::class, 'receive']);
