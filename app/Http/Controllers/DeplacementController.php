<?php

namespace App\Http\Controllers;

use App\Models\Deplacement;
use App\Models\User;
use App\Models\Vehicule;
use App\Models\Projet;
use Illuminate\Http\Request;

class DeplacementController extends Controller
{
    public function index()
    {
        $deplacements = Deplacement::latest()->paginate(10);
        return view('deplacements.index', compact('deplacements'));
    }

    public function create()
    {
        $users = User::all();
        $vehicules = Vehicule::all();
        $projets = Projet::all();
        return view('deplacements.create', compact('users', 'vehicules', 'projets'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code_deplacement' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_prevus' => 'nullable|date',
            'date_retour' => 'nullable|date',
            'litineraire' => 'nullable|string',
            'km_depart' => 'nullable|integer',
            'km_retour' => 'nullable|integer',
            'carburant_initial' => 'nullable|integer',
            'carburant_restant' => 'nullable|integer',
            'motif' => 'nullable|string',
            'frais_mission' => 'nullable|numeric',
            'statut' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'projet_id' => 'required|exists:projets,id',
            'approved_by' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        // Calcul automatique
        if (isset($data['km_depart'], $data['km_retour'])) {
            $data['km_parcourus'] = $data['km_retour'] - $data['km_depart'];
        }

        if (isset($data['carburant_initial'], $data['carburant_restant'])) {
            $data['carburant_consomme'] = $data['carburant_initial'] - $data['carburant_restant'];
        }

        Deplacement::create($data);

        return redirect()->route('deplacements.index')->with('success', 'Déplacement créé avec succès.');
    }

    public function show(Deplacement $deplacement)
    {
        return view('deplacements.show', compact('deplacement'));
    }

    public function edit(Deplacement $deplacement)
    {
        $users = User::all();
        $vehicules = Vehicule::all();
        $projets = Projet::all();
        return view('deplacements.edit', compact('deplacement', 'users', 'vehicules', 'projets'));
    }

    public function update(Request $request, Deplacement $deplacement)
    {
        $data = $request->validate([
            'code_deplacement' => 'required|string|max:255',
            'date_depart' => 'required|date',
            'date_prevus' => 'nullable|date',
            'date_retour' => 'nullable|date',
            'litineraire' => 'nullable|string',
            'km_depart' => 'nullable|integer',
            'km_retour' => 'nullable|integer',
            'carburant_initial' => 'nullable|integer',
            'carburant_restant' => 'nullable|integer',
            'motif' => 'nullable|string',
            'frais_mission' => 'nullable|numeric',
            'statut' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'vehicule_id' => 'required|exists:vehicules,id',
            'projet_id' => 'required|exists:projets,id',
            'approved_by' => 'nullable|integer',
            'description' => 'nullable|string',
        ]);

        // Calcul automatique
        if (isset($data['km_depart'], $data['km_retour'])) {
            $data['km_parcourus'] = $data['km_retour'] - $data['km_depart'];
        }

        if (isset($data['carburant_initial'], $data['carburant_restant'])) {
            $data['carburant_consomme'] = $data['carburant_initial'] - $data['carburant_restant'];
        }

        $deplacement->update($data);

        return redirect()->route('deplacements.index')->with('success', 'Déplacement mis à jour avec succès.');
    }

    public function destroy(Deplacement $deplacement)
    {
        $deplacement->delete();
        return redirect()->route('deplacements.index')->with('success', 'Déplacement supprimé avec succès.');
    }
}