<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    public function index()
    {
        $employes = Employe::latest()->paginate(10);
        return view('employes.index', compact('employes'));
    }

    public function create()
    {
        return view('employes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'residence' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Employe::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'telephone' => $request->telephone,
            'residence' => $request->residence,
            'fonction' => $request->fonction,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('employes.index')
            ->with('success', 'Employé ajouté avec succès.');
    }

    public function edit(Employe $employe)
    {
        return view('employes.edit', compact('employe'));
    }

    public function update(Request $request, Employe $employe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'residence' => 'nullable|string|max:255',
            'fonction' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $employe->update($request->all());

        return redirect()->route('employes.index')
            ->with('success', 'Employé modifié avec succès.');
    }

    public function destroy(Employe $employe)
    {
        $employe->delete();

        return redirect()->route('employes.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}