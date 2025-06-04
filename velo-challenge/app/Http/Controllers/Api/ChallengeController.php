<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;

class ChallengeController extends Controller
{
    public function index()
    {
        // Retourne tous les challenges avec leurs créateurs
        return response()->json(
            Challenge::with('creator')->paginate(10)
        );
    }


    public function show($id)
    {
        $challenge = Challenge::with(['creator', 'participants', 'activities'])->find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge non trouvé'], 404);
        }

        return response()->json($challenge);
    }

    
    public function store(Request $request)
    {
        // 1. Valider les données
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'difficulty' => 'required|in:debutant,intermediaire,avance',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        // 2. Créer le challenge
        $challenge = Challenge::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'difficulty' => $request->difficulty,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'created_by' => $request->user()->id
        ]);

        // 3. Retourner la réponse
        return response()->json($challenge, 201);
    }
}
