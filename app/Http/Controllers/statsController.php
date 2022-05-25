<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\P_persone as Pointage;
use App\Models\Materiel;
use Illuminate\Support\Facades\DB;
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
        $chart1 = Materiel::join("affectation_materiels","affectation_materiels.id_materiel","materiels.id")
        ->groupBy("affectation_materiels.id_materiel","materiels.marqueM")
        ->select(DB::raw("count(affectation_materiels.id_materiel) as count1"),"materiels.marqueM")->Limit(5)
        ->orderBy("count1","desc")
        ->get();
        return \response()->json([
            "emp"=>$emp,
            "Pemp"=>$Pemp,
            "mat"=>$mat,
            "Pmat"=>$Pmat,
            "dep"=>$dep,
            "status"=>1,
            'chart1'=>$chart1
        ]); 
    }
}

