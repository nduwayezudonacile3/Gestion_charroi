<?php

namespace App\Http\Controllers;

use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehiculeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('vehicules.index', compact('vehicules'));
    }

    public function create()
    {
        return view('vehicules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'immatriculation' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'status' => 'required|in:disponible,indisponible,au service,maintenance',
            'description' => 'nullable|string',
            'annee_fabrication' => 'required|string|max:4'
        ]);
        $data['user_id'] = Auth::id();

        Vehicule::create($data);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule ajouté avec succès.');
    }

    public function show(Vehicule $vehicule)
    {
        return view('vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule)
    {
        return view('vehicules.edit', compact('vehicule'));
    }

    public function update(Request $request, Vehicule $vehicule)
    {
        $data = $request->validate([
            'immatriculation' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'marque' => 'required|string|max:255',
            'status' => 'required|in:disponible,indisponible,au service,maintenance',
            'description' => 'nullable|string',
            'annee_fabrication' => 'required|string|max:4'
        ]);

        
        $data['user_id'] = Auth::id();
        $vehicule->update($data);

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour avec succès.');
    }

    public function destroy(Vehicule $vehicule)
    {
        $vehicule->delete();
        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé avec succès.');
    }
}
