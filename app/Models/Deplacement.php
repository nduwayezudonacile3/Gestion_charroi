<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deplacement extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_deplacement',
        'date_depart',
        'date_prevus',
        'date_retour',
        'litineraire',
        'km_depart',
        'carburant_initial',
        'km_retour',
        'km_parcourus',
        'carburant_restant',
        'carburant_consomme',
        'motif',
        'frais_mission',
        'status',
        'user_id',
        'vehicule_id',
        'projet_id',
        'employe_id',
        'approved_by',
        'description',
    ];

    // Relation avec Projet
    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    // Relation avec Véhicule
    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    // Relation avec Utilisateur (créateur du déplacement)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec Employés
    public function employes()
    {
        return $this->belongsToMany(Employe::class, 'deplacement_employes', 'deplacement_id', 'employe_id');
    }

    // Relation avec l’utilisateur qui approuve (approved_by)
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
