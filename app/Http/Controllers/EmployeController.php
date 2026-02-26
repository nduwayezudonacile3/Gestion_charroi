<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;

class EmployeController extends Controller
{
    // Liste tous les employés
    public function index()
    {
        $employes = Employe::all();
        return view('employes.liste', compact('employes'));
    }

    // Formulaire pour ajouter
    public function create()
    {
        return view('employes.ajouter');
    }

    // STOCKER un nouvel employé
    public function store(StoreEmployeRequest $request)
    {
        Employe::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'residence' => $request->residence,
            'fonction' => $request->fonction,
            'description' => $request->description,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('employes.liste')->with('success', 'Employé ajouté !');
    }

    // Formulaire pour modifier
    public function edit(Employe $employe)
    {
        return view('employes.update', compact('employe'));
    }

    // METTRE À JOUR un employé existant
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        $employe->update([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'residence' => $request->residence,
            'fonction' => $request->fonction,
            'description' => $request->description,
        ]);

        return redirect()->route('employes.liste')->with('success', 'Employé mis à jour !');
    }

    // Supprimer un employé
    public function destroy(Employe $employe)
    {
        $employe->delete();
        return redirect()->route('employes.liste')->with('success', 'Employé supprimé !');
    }
}