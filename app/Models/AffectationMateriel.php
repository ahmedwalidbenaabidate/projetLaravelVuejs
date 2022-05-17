<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AffectationMateriel extends Model
{
    use HasFactory;
    protected $fillable =['id_employee','date_debut','date_fin','id_materiel','statut'];
}
