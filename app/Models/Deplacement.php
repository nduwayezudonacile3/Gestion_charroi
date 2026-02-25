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
        'statut',
        'user_id',
        'vehicule_id',
        'projet_id',
        'approved_by',
        'description',
    ];

    protected $casts = [
        'date_depart' => 'datetime',
        'date_prevus' => 'datetime',
        'date_retour' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicule()
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function projet()
    {
        return $this->belongsTo(Projet::class);
    }

    // utilisateur qui approuve
    public function approbateur()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
public function employes()
{
    return $this->belongsToMany(
        Employe::class,
        'deplacementemployes'
    );
}
}
