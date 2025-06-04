<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChallengeController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/challenges', [ChallengeController::class, 'index']);
Route::get('/challenges/{id}', [ChallengeController::class, 'show']);

// Authentifié
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Admin seulement
Route::middleware(['auth:sanctum'])->post('/challenges', [ChallengeController::class, 'store']);


