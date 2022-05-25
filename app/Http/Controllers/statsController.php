<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\P_persone as Pointage;
use App\Models\Materiel;
use App\Models\AffectationMateriel;
use App\Models\Depense;
Use \Carbon\Carbon;

use Illuminate\Http\Request;

class statsController extends Controller
{
    public function index(){
        $dateNow = Carbon::now()->format('Y-m-d');
        $emp = Employee::get()->count();
        $Pemp = Pointage::where("date_pointage","like","%".$dateNow."%")->get()->count();
        $mat = Materiel::get()->count();
        $Pmat = AffectationMateriel::where("date_debut","like","%".$dateNow."%")->get()->count();
        $dep = Depense::where("dateDepense","like","%".$dateNow."%")->get()->count();
        return \response()->json([
            "emp"=>$emp,
            "Pemp"=>$Pemp,
            "mat"=>$mat,
            "Pmat"=>$Pmat,
            "dep"=>$dep,
            "status"=>1,
        ]); 
    }
}

