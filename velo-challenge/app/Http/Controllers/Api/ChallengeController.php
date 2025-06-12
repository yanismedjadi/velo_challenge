<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function destroy($id)
    {
        $challenge = Challenge::find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge non trouvé.'], 404);
        }

        $challenge->delete();

        return response()->json(['message' => 'Challenge supprimé avec succès.']);
    }


    public function join($id)
    {
        $user = request()->user();
        if ($user->role !== 'user') {
            return response()->json(['message' => 'Seuls les utilisateurs peuvent rejoindre un challenge.'], 403);
        }

        $challenge = Challenge::find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge non trouvé.'], 404);
        }

        // Vérifier si l'utilisateur est déjà inscrit
        $alreadyJoined = DB::table('challenge_participants')
            ->where('user_id', $user->id)
            ->where('challenge_id', $id)
            ->exists();

        if ($alreadyJoined) {
            return response()->json(['message' => 'Vous participez déjà à ce challenge.'], 409);
        }

        // Insérer dans challenge_participants
        DB::table('challenge_participants')->insert([
            'user_id' => $user->id,
            'challenge_id' => $id,
            'joined_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Inscription au challenge réussie.']);
    }

    public function myChallenges(Request $request)
    {
        $user = $request->user();

        $challenges = $user->challengesParticipated()->get();

        return response()->json($challenges);
    }

    public function ranking(Request $request, $id)
    {
        $challenge = Challenge::find($id);

        if (!$challenge) {
            return response()->json(['message' => 'Challenge non trouvé.'], 404);
        }

        $validSorts = [
            'total' => 'total_km',
            'rain' => 'rain_km',
            'night' => 'night_km',
            'with_kids' => 'with_kids_km',
        ];

        $sortParam = $request->query('by', 'total'); // par défaut : total
        $sortColumn = $validSorts[$sortParam] ?? 'total_km'; // fallback

        $ranking = DB::table('activities')
            ->join('users', 'activities.user_id', '=', 'users.id')
            ->select(
                'users.id as user_id',
                DB::raw('CONCAT(users.first_name, " ", users.last_name) as name'),
                DB::raw('SUM(activities.distance_km) as total_km'),
                DB::raw('SUM(activities.distance_km * activities.rain) as rain_km'),
                DB::raw('SUM(activities.distance_km * activities.night) as night_km'),
                DB::raw('SUM(activities.distance_km * activities.with_kids) as with_kids_km')
            )
            ->where('activities.challenge_id', $id)
            ->groupBy('users.id', 'users.first_name', 'users.last_name')
            ->orderByDesc($sortColumn)
            ->get();

        return response()->json($ranking);
    }
}
