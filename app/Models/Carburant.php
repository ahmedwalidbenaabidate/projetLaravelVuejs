<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carburant extends Model
{
    use HasFactory;
    protected $fillable = ['id_materiel','quantiteC','typeC','dateC','observation'];
}
