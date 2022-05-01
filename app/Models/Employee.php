<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['reference','nom', 'prenom', 'adresse','cin','salaire','type_salaire','permisDate','qualite_id'];
}
