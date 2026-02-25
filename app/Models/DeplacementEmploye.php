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

    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function deplacement()
    {
        return $this->belongsTo(Deplacement::class);
    }
}
