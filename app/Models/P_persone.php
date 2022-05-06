<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class P_persone extends Model
{
    use HasFactory;

    protected $fillable = ['id_employee','presence','heurs_suppl','remarque','date_pointage'];
}
