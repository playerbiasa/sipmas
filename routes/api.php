<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayananApi\ApiController;


Route::get('/prodi', [ApiController::class, 'programstudi']);
Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

Route::post('/verifyotp', [ApiController::class, 'verifyOtp']);
Route::post('/resendotp', [ApiController::class, 'resendOtp']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [ApiController::class, 'logout']);
});
