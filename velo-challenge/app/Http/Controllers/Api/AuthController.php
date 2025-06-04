<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:Homme,Femme',
            'birth_date' => 'required|date'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password_hash' => Hash::make($request->password),
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'role' => 'user'
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Chercher l'utilisateur par email
        $user = User::where('email', $request->email)->first();

        // Vérifier l’existence et le mot de passe
        if (!$user || !Hash::check($request->password, $user->password_hash)) {
            return response()->json([
                'message' => 'Identifiants invalides'
            ], 401);
        }

        // Générer un token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Retourner le token + l'utilisateur
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }


    public function profile(Request $request)
    {
        if (!$request->user()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return response()->json($request->user());
    }


    public function logout(Request $request)
    {
        // Supprime tous les tokens de l'utilisateur connecté
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Déconnexion réussie'
        ]);
    }


}
