<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjetController extends Controller
{
    // Liste des projets
    public function index()
    {
        $projets = Projet::all();
        return view('projets.index', compact('projets'));
    }

    // Formulaire de création
    public function create()
    {
        return view('projets.create');
    }

    // Enregistrement d'un projet
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_projet'   => 'required|string|max:255',
            'nom_projet'    => 'required|string|max:255',
            'delais_projet' => 'required|string|max:255',
            'budget'        => 'required|numeric',
            'statut'        => 'nullable|numeric',
            'description'   => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        Projet::create($validated);

        return redirect()->route('projets.index')->with('success', 'Projet créé avec succès.');
    }

    // Formulaire d'édition
    public function edit(Projet $projet)
    {
        return view('projets.edit', compact('projet'));
    }

    // Mise à jour d'un projet
    public function update(Request $request, Projet $projet)
    {
        $validated = $request->validate([
            'code_projet'   => 'required|string|max:255',
            'nom_projet'    => 'required|string|max:255',
            'delais_projet' => 'required|string|max:255',
            'budget'        => 'required|numeric',
            'statut'        => 'nullable|numeric',
            'description'   => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $projet->update($validated);

        return redirect()->route('projets.index')->with('success', 'Projet mis à jour avec succès.');
    }

    // Suppression d'un projet
    public function destroy(Projet $projet)
    {
        $projet->delete();
        return redirect()->route('projets.index')->with('success', 'Projet supprimé avec succès.');
    }
}