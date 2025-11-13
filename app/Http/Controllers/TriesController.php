<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; // <- corregido: "Illuminate" en lugar de "Illuminte"
use App\Models\Tries;

class TriesController extends Controller
{

    /**
     * Display a listing of the resource (with pagination).
     */
    public function index(Request $request)
    {
        //$perPage = $request->input('per_page', 10);

        $teams = Tries::all();
        //$teams = Tries::paginate($perPage);

        return response()->json($teams, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team = new Tries();
        $team->name = $request->input('name');
        $team->quantity = $request->input('estudios');
        $team->save();

        return response()->json($team, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $team = Tries::findOrFail($id);
        $team->name = $request->input('name', $team->name);
        $team->quantity = $request->input('estudios', $team->estudios);
        $team->save();

        return response()->json($team);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Tries::findOrFail($id);
        $team->delete();

        return response()->json(['message' => 'Tries deleted successfully']);
    }

    public function storeTen(Request $request)
    {
        $teams = 1000;
        $teams = [
            ['name' => 'Pepito', 'estudios' => 'ASI'],
            ['name' => 'Pepita', 'estudios' => 'ASI'],
            ['name' => 'Fulanito', 'estudios' => 'ASI'],
            ['name' => 'Fulanita', 'estudios' => 'ASI'],
            ['name' => 'Perano', 'estudios' => 'ASI'],
            ['name' => 'Perana', 'estudios' => 'ASI'],
            ['name' => 'Mengano', 'estudios' => 'ASI'],
            ['name' => 'Mengana', 'estudios' => 'ASI'],
            ['name' => 'Ana Lorena', 'estudios' => 'Ingenieria de sistemas y computacion'],
            ['name' => 'Luz Stella', 'estudios' => 'Ingenieria de sistemas y computacion '],
        ];

        foreach ($teams as $team) {
            Tries::create($team);
        }

        return response()->json([
            'message' => '10 tries guardados exitosamente',
            'data' => Tries::latest()->take(10)->get()
        ], 201);
    }
}
