<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_projet',
        'nom_projet',
        'delais_projet',
        'budget',
        'description',
        'user_id',
    ];

    // Relation : un projet appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deplacements()
{
    return $this->hasMany(Deplacement::class);
}
}
