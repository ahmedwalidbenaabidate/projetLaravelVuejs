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
        $chart2 = Employee::join("p_persones","p_persones.id_employee","employees.id")
        ->where("presence","=","1")
        ->groupBy("p_persones.id_employee","employees.nom","employees.prenom")
        ->select(DB::raw("count(p_persones.id_employee) as count1"),"employees.nom","employees.prenom")->Limit(5)
        ->orderBy("count1","desc")
        ->get();
        $chart3 = Materiel::join("type_materiels","type_materiels.id","materiels.typeMateriel_id")
        ->select(DB::raw("count(materiels.typeMateriel_id) as count1"),"type_materiels.libelleMateriel")
        ->groupBy("materiels.typeMateriel_id","type_materiels.libelleMateriel")->Limit(10)
        ->orderBy("count1","desc")
        ->get();
        $chart4 = Employee::join("qualites","qualites.id","employees.qualite_id")
        ->groupBy("qualites.id","qualites.libelleFonction")
        ->select(DB::raw("count(qualites.id) as count1"),"qualites.libelleFonction")->Limit(10)
        ->orderBy("count1","desc")
        ->get();
        return \response()->json([
            "emp"=>$emp,
            "Pemp"=>$Pemp,
            "mat"=>$mat,
            "Pmat"=>$Pmat,
            "dep"=>$dep,
            "status"=>1,
            'chart1'=>$chart1,
            'chart2'=>$chart2,
            'chart3'=>$chart3,
            'chart4'=>$chart4,
        ]); 
    }
}

