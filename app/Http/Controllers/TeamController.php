<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // <- corregido: "Illuminate" en lugar de "Illuminte"
use App\Models\Team;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource (with pagination).
     */
    public function index(Request $request)
    {
        // Puedes personalizar el número de resultados por página con ?per_page=10 en la URL
        $perPage = $request->input('per_page', 10);

        $teams = Team::paginate($perPage);

        return response()->json($teams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team = new Team();
        $team->name = $request->input('name');
        $team->quantity = $request->input('quantity');
        $team->save();

        return response()->json($team, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Team::findOrFail($id);
        $team->name = $request->input('name', $team->name);
        $team->quantity = $request->input('quantity', $team->quantity);
        $team->save();

        return response()->json($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Team deleted successfully']);
    }

    public function storeTen(Request $request)
    {
        $teams = [
            ['name' => 'Team Alpha', 'quantity' => 5],
            ['name' => 'Team Beta', 'quantity' => 8],
            ['name' => 'Team Gamma', 'quantity' => 10],
            ['name' => 'Team Delta', 'quantity' => 6],
            ['name' => 'Team Epsilon', 'quantity' => 12],
            ['name' => 'Team Zeta', 'quantity' => 9],
            ['name' => 'Team Eta', 'quantity' => 4],
            ['name' => 'Team Theta', 'quantity' => 11],
            ['name' => 'Team Iota', 'quantity' => 7],
            ['name' => 'Team Kappa', 'quantity' => 13],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }

        return response()->json([
            'message' => '10 equipos guardados exitosamente',
            'data' => Team::latest()->take(10)->get()
        ], 201);
    }
}
