<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'challenge_id' => 'required|exists:challenges,id',
            'date' => 'required|date',
            'distance_km' => 'required|numeric|min:0.1',
            'rain' => 'nullable|numeric|min:0',
            'night' => 'nullable|numeric|min:0',
            'with_kids' => 'nullable|numeric|min:0'

        ]);

        $activity = Activity::create([
            'user_id' => $request->user()->id,
            'challenge_id' => $request->challenge_id,
            'date' => $request->date,
            'distance_km' => $request->distance_km,
            'rain' => $request->rain ?? 0,
            'night' => $request->night ?? 0,
            'with_kids' => $request->with_kids ?? 0,
        ]);

        return response()->json($activity, 201);
    }

    public function index(Request $request)
    {
        $activities = $request->user()->activities()->with('challenge')->latest()->get();
        return response()->json($activities);
    }

    public function destroy($id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return response()->json(['message' => 'Activité non trouvée.'], 404);
        }

        if ($activity->user_id !== auth()->id()) {
            return response()->json(['message' => 'Non autorisé.'], 403);
        }

        $activity->delete();

        return response()->json(['message' => 'Activité supprimée avec succès.']);
    }

}
