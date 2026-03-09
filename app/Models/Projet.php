<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_projet',
        'nom_projet',
        'date_debut',
        'date_cloture',
         'statut',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatutColorAttribute()
    {
        $dateDebut = Carbon::parse($this->date_debut);
        $dateCloture = Carbon::parse($this->date_cloture);
        $now = Carbon::now();

        // Projet terminé (date actuelle > date_cloture)
        if ($now->greaterThan($dateCloture)) {
            return 'secondary'; // gris
        }

        // Temps restant jusqu'à la clôture
        $tempsRestant = $now->diffInMonths($dateCloture);

        if ($tempsRestant >= 1 && $tempsRestant <= 4) {
            return 'success'; // vert
        } elseif ($tempsRestant >= 5 && $tempsRestant <= 8) {
            return 'warning'; // jaune
        } elseif ($tempsRestant >= 9 && $tempsRestant <= 12) {
            return 'danger'; // rouge
        } else {
            return 'secondary'; // gris
        }
    }

    public function getStatutTextAttribute()
    {
        $dateDebut = Carbon::parse($this->date_debut);
        $dateCloture = Carbon::parse($this->date_cloture);
        $now = Carbon::now();

        // Projet terminé (date actuelle > date_cloture)
        if ($now->greaterThan($dateCloture)) {
            return 'Terminé';
        }

        // Temps restant jusqu'à la clôture
        $tempsRestant = $now->diffInMonths($dateCloture);

        if ($tempsRestant >= 1 && $tempsRestant <= 4) {
            return 'En cours';
        } elseif ($tempsRestant >= 5 && $tempsRestant <= 8) {
            return 'En cours';
        } elseif ($tempsRestant >= 9 && $tempsRestant <= 12) {
            return 'Presque terminé';
        } else {
            return 'Terminé';
        }
    }
}




