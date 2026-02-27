<?php

namespace App\Http\Controllers;

use App\Models\DeplacementEmploye;
use App\Models\Employe;
use App\Models\Deplacement;
use Illuminate\Http\Request;

class DeplacementEmployeController extends Controller
{
    public function index()
    {
        $deplacementemployes = DeplacementEmploye::with(['employe','deplacement'])
                                ->latest()->paginate(10);

        return view('deplacementemployes.index', compact('deplacementemployes'));
    }

    public function create()
    {
        $employes = Employe::all();
        $deplacements = Deplacement::all();

        return view('deplacementemployes.create', compact('employes','deplacements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employe_id' => 'required|exists:employe,id',
            'deplacement_id' => 'required|exists:deplacement,id',
        ]);

        DeplacementEmploye::create($request->all());

        return redirect()->route('deplacementemployes.index')
            ->with('success', 'Affectation créée avec succès');
    }

    public function edit(DeplacementEmploye $deplacementemploye)
    {
        $employes = Employe::all();
        $deplacements = Deplacement::all();

        return view('deplacementemployes.edit',
            compact('deplacementemploye','employes','deplacements'));
    }

    public function update(Request $request, DeplacementEmploye $deplacementemploye)
    {
        $request->validate([
            'employe_id' => 'required|exists:employe,id',
            'deplacement_id' => 'required|exists:deplacement,id',
        ]);

        $deplacementemploye->update($request->all());

        return redirect()->route('deplacementemployes.index')
            ->with('success', 'Affectation modifiée avec succès');
    }

    public function destroy(DeplacementEmploye $deplacementemploye)
    {
        $deplacementemploye->delete();

        return redirect()->route('deplacementemployes.index')
            ->with('success', 'Affectation supprimée');
    }
}