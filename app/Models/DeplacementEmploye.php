<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeplacementEmploye extends Model
{
    use HasFactory;

    protected $table = 'deplacementemployes';

    protected $fillable = [
        'employe_id',
        'deplacement_id',
    ];

    public $timestamps = false;

    // Dans Deplacement.php
public function employes() {
    return $this->belongsToMany(Employe::class, 'deplacement_employes');
}

// Dans Employe.php
public function deplacements() {
    return $this->belongsToMany(Deplacement::class, 'deplacement_employes');
}
}
