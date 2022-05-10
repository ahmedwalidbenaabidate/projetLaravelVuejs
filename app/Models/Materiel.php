<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    use HasFactory;
    protected $fillable =['marqueM','modelM','etatM','date_AchatM','date_FonctionM','typeMateriel_id'];
}
