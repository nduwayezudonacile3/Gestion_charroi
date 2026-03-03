<?php

namespace App\Http\Controllers;

use App\Models\Deplacement;
use App\Models\Projet;
use App\Models\Vehicule;
use App\Models\Employe;
use App\Models\User;
use Illuminate\Http\Request;

class DeplacementController extends Controller
{
    // Liste des déplacements
    public function index()
    {
        $deplacements = Deplacement::with(['projet','vehicule','employes','user','approvedBy'])
            ->orderBy('id','desc')
            ->paginate(10);

        return view('deplacements.index', compact('deplacements'));
    }

    // Formulaire création
    public function create()
    {
        $projets = Projet::all();
        $vehicules = Vehicule::all();
        $employes = Employe::all();
        $users = User::all();

        return view('deplacements.create', compact('projets','vehicules','employes','users'));
    }

    // Enregistrement
  public function store(Request $request)
{
    $request->validate([
        'projet_id'          => 'required|exists:projets,id',
        'vehicule_id'        => 'required|exists:vehicules,id',
        'employe_ids'        => 'required|array|min:1',
        'employe_ids.*'      => 'exists:employes,id',
        'litineraire'        => 'required|string',
        'date_depart'        => 'required|date',
        'date_prevus'        => 'required|date',
        'km_depart'          => 'required|numeric',
        'carburant_initial'  => 'required|numeric',
        'motif'              => 'required|string',
        'frais_mission'      => 'nullable|numeric',
        'description'        => 'nullable|string',
        'date_retour'        => 'nullable|date',
        'km_retour'          => 'nullable|numeric',
        'carburant_restant'  => 'nullable|numeric',
        'approved_by'        => 'nullable|exists:users,id',
    ]);


    $code = 'DEP-' . strtoupper(uniqid());

    $deplacement = Deplacement::create([
        'code_deplacement'   => $code,
        'projet_id'          => $request->projet_id,
        'vehicule_id'        => $request->vehicule_id,
        'user_id'            => auth()->id(),
        'litineraire'        => $request->litineraire,
        'date_depart'        => $request->date_depart,
        'date_prevus'        => $request->date_prevus,
        'km_depart'          => $request->km_depart,
        'carburant_initial'  => $request->carburant_initial,
        'motif'              => $request->motif,
        'frais_mission'      => $request->frais_mission,
        'description'        => $request->description,
        'date_retour'        => $request->date_retour,
        'km_retour'          => $request->km_retour,
        'carburant_restant'  => $request->carburant_restant,
        'approved_by'        => $request->approved_by,
        'status'             => $request->status ?? 'En cours',
    ]);

    // Attacher les employés sélectionnés via la table pivot
    $deplacement->employes()->attach($request->employe_ids);

    return redirect()->route('deplacements.index')->with('success','Déplacement créé avec succès.');
}



    // Affichage détail
    public function show($id)
    {
        $deplacement = Deplacement::with(['projet','vehicule','employes','user','approvedBy'])->findOrFail($id);
        return view('deplacements.show', compact('deplacement'));
    }

public function terminer($id)
{
    $deplacement = Deplacement::findOrFail($id);
    $users = User::all();

    // Vérifie que le déplacement est en cours
    // if ($deplacement->status !== 'En cours') {
    //     return redirect()->back()->with('error', 'Ce déplacement n\'est pas en cours.');
    // }

    return view('deplacements.terminer', compact('deplacement', 'users'));
}


public function storeTerminer(Request $request, $id)
{
    $deplacement = Deplacement::findOrFail($id);

    $request->validate([
        'date_retour' => 'required|date',
        'km_retour' => 'required|numeric|min:' . $deplacement->km_depart,
        'carburant_restant' => 'required|numeric|min:0',
        'approved_by' => 'nullable|string|max:255',
    ]);

    $deplacement->update([
        'date_retour' => $request->date_retour,
        'km_retour' => $request->km_retour,
        'km_parcouru' => $request->km_retour - $deplacement->km_depart,
        'carburant_restant' => $request->carburant_restant,
        'carburant_consomme' => $deplacement->carburant_initial - $request->carburant_restant,
        'approved_by' => $request->approved_by,
        'status' => 'Termine',
    ]);

    // Mettre le véhicule disponible à nouveau si utilisé
    if($deplacement->vehicule){
        $deplacement->vehicule->update(['status' => 'Disponible']);
    }

    return redirect()->route('deplacements.index')->with('success', 'Fin de mission enregistrée avec succès.');
}
    // Formulaire édition
    public function edit($id)
    {
        $deplacement = Deplacement::findOrFail($id);
        $projets = Projet::all();
        $vehicules = Vehicule::all();
        $employes = Employe::all();
        $users = User::all();

        return view('deplacements.edit', compact('deplacement','projets','vehicules','employes','users'));
    }
    public function selectFin()
{
    // Récupérer uniquement les déplacements "En cours"
    $deplacements = Deplacement::where('status', 'En cours')->get();

    return view('deplacements.fin-mission', compact('deplacements'));
}
public function finMission(Request $request)
{
    // Récupérer le premier déplacement "En cours"
    $deplacement = Deplacement::where('status', 'En cours')->first();

    if (!$deplacement) {
        return redirect()->back()->with('error', 'Aucun déplacement en cours à terminer.');
    }

    // Validation des champs
    $request->validate([
        'carburant_restant' => 'required|numeric|min:0',
        'carburant_consomme' => 'required|numeric|min:0',
        'km_retour' => 'required|numeric|min:0',
        'approved_by' => 'required|string|max:255',
    ]);

    // Calcul du km parcouru
    $km_parcouru = $request->km_retour - ($deplacement->km_depart ?? 0);

    // Mettre à jour le déplacement
    $deplacement->status = 'Termine';
    $deplacement->date_retour = now();
    $deplacement->km_retour = $request->km_retour;
    $deplacement->km_parcouru = $km_parcouru;
    $deplacement->carburant_restant = $request->carburant_restant;
    $deplacement->carburant_consomme = $request->carburant_consomme;
    $deplacement->approved_by = $request->approved_by;

    $deplacement->save();

    return redirect()->back()->with('success', 'La mission a été terminée avec succès.');
}

    // Mise à jour
    public function update(Request $request, $id)
    {
        $deplacement = Deplacement::findOrFail($id);

        $request->validate([
            'code_deplacement'   => 'required|string|max:50|unique:deplacements,code_deplacement,'.$deplacement->id,
            'projet_id'          => 'required|exists:projets,id',
            'vehicule_id'        => 'required|exists:vehicules,id',
            'user_id'            => 'required|exists:users,id',
            'employe_ids'        => 'required|array|min:1',
            'employe_ids.*'      => 'exists:employes,id',
            'litineraire'        => 'required|string',
            'date_depart'        => 'required|date',
            'date_prevus'        => 'required|date',
            'km_depart'          => 'required|numeric',
            'carburant_initial'  => 'required|numeric',
            'motif'              => 'required|string',
            'frais_mission'      => 'nullable|numeric',
            'description'        => 'nullable|string',
            'date_retour'        => 'nullable|date',
            'km_retour'          => 'nullable|numeric',
            'carburant_restant'  => 'nullable|numeric',
            'approved_by'        => 'nullable|exists:users,id',
        ]);

        $km_parcourus = $request->filled('km_retour') ? $request->km_retour - $request->km_depart : null;
        $carburant_consomme = $request->filled('carburant_restant') ? $request->carburant_initial - $request->carburant_restant : null;

        $deplacement->update([
            'code_deplacement'   => $request->code_deplacement,
            'projet_id'          => $request->projet_id,
            'vehicule_id'        => $request->vehicule_id,
            'user_id'            => $request->user_id,
            'litineraire'        => $request->litineraire,
            'date_depart'        => $request->date_depart,
            'date_prevus'        => $request->date_prevus,
            'km_depart'          => $request->km_depart,
            'carburant_initial'  => $request->carburant_initial,
            'motif'              => $request->motif,
            'frais_mission'      => $request->frais_mission,
            'description'        => $request->description,
            'date_retour'        => $request->date_retour,
            'km_retour'          => $request->km_retour,
            'km_parcourus'       => $km_parcourus,
            'carburant_restant'  => $request->carburant_restant,
            'carburant_consomme' => $carburant_consomme,
            'approved_by'        => $request->approved_by,
            'status'             => $request->status,
        ]);

        // Synchroniser les employés sélectionnés via la table pivot
        $deplacement->employes()->sync($request->employe_ids);

        return redirect()->route('deplacements.index')->with('success','Déplacement mis à jour.');
    }

    // Suppression
    public function destroy($id)
    {
        $deplacement = Deplacement::findOrFail($id);
        $deplacement->delete();

        return redirect()->route('deplacements.index')->with('success','Déplacement supprimé.');
    }
}
