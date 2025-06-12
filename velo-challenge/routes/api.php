<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ChallengeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\UserController;

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

//////////// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/challenges', [ChallengeController::class, 'index']);
Route::get('/challenges/{id}', [ChallengeController::class, 'show']);

// Classement
Route::get('/challenges/{id}/ranking', [ChallengeController::class, 'ranking']);

//////////// Authentifié

// Récupérer les info sur le profil
Route::middleware('auth:sanctum')->get('/profile', [AuthController::class, 'profile']);

// Déconnexion
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Rejoindre un challenge (uniquement pour les users)
Route::middleware('auth:sanctum')->post('/challenges/{id}/join', [ChallengeController::class, 'join']);

// Récupérer les challenge pour lequels l'user s'est inscrit
Route::middleware('auth:sanctum')->get('/my-challenges', [ChallengeController::class, 'myChallenges']);

// Déclarer une activité
Route::middleware('auth:sanctum')->post('/activities', [ActivityController::class, 'store']);

// Récupérer toutes les activités d'un utilisateur
Route::middleware('auth:sanctum')->get('/activities', [ActivityController::class, 'index']);

// Supprimer une activité
Route::middleware('auth:sanctum')->delete('/activities/{id}', [ActivityController::class, 'destroy']);

//////////// Admin seulement

// Créer un challenge
Route::middleware(['auth:sanctum', 'isAdmin'])->post('/challenges', [ChallengeController::class, 'store']);

// Supprimer un challenge
Route::middleware(['auth:sanctum', 'isAdmin'])->delete('/challenges/{id}', [ChallengeController::class, 'destroy']);

// Controle de des utilisateur
Route::middleware(['auth:sanctum', 'isAdmin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});