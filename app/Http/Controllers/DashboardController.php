<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employe;
use App\Models\Vehicule;
use App\Models\Projet;
use App\Models\Deplacement;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques totales
        $stats = [
            'employes' => Employe::count(),
            'vehicules' => Vehicule::count(),
            'projets' => Projet::count(),
            'deplacements' => Deplacement::count(),
            'users' => User::count(),
        ];

        // Statistiques projets par statut
        $projetsStatuts = Projet::select('statut', DB::raw('count(*) as total'))
            ->groupBy('statut')
            ->pluck('total', 'statut'); // clé = statut, valeur = total

        // Derniers employés
        $dernierEmployes = Employe::latest()->take(5)->get();

        // Derniers projets
        $dernierProjets = Projet::latest()->take(5)->get();

        return view('dashboard', compact(
            'stats', 
            'projetsStatuts', 
            'dernierEmployes', 
            'dernierProjets'
        ));
    }
}