<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;

    protected $fillable = [
        'immatriculation',
        'categorie',
        'marque',
        'status',
        'description',
        'annee_fabrication',
        'user_id',
    ];

    // Relation : un véhicule appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deplacements()
{
    return $this->hasMany(Deplacement::class);
}
}
