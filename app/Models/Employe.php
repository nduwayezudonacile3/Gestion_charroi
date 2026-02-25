<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'residence',
        'fonction',
        'description',
        'user_id',
    ];


    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Relation : un employé appartient à un user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function deplacements()
{
    return $this->belongsToMany(
        Deplacement::class,
        'deplacementemployes'
    );
}
}
