<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;
    protected $fillable = ['id_materiel','dateDepense','description','id_employee','totalTCC','bonDepense'];
}
