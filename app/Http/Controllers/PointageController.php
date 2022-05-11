<?php

namespace App\Http\Controllers;

use App\Models\P_persone;
use Illuminate\Http\Request;
Use \Carbon\Carbon;
use App\Models\Employee;


class PointageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employee::join("p_persones","employees.id","=","p_persones.id_employee")
        ->join("qualites","employees.qualite_id","=","qualites.id")
        ->select("p_persones.id","id_employee","nom","prenom","libelleFonction","presence","heurs_suppl","remarque","date_pointage")
        ->latest("p_persones.created_at")
        ->get();
          return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    public function indexAfficherAbsParDate($date_pointage)
    {
        $data = Employee::join("p_persones","employees.id","=","p_persones.id_employee")
        ->join("qualites","employees.qualite_id","=","qualites.id")
        ->select("id_employee","nom","prenom","libelleFonction","presence","heurs_suppl","remarque","date_pointage")
        ->where("date_pointage","=","$date_pointage")
        ->latest("p_persones.created_at")
        ->get();
          return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    public function indexAfficherAbs()
    {
        
        // $dateNow = Carbon::now()->format('Y-m-d');
        // $data = Employee::join("p_persones","p_persones.id_employee","=","employees.id")
        // ->join("qualites","qualites.id","=","employees.qualite_id")
        // ->select("employees.id","nom","prenom","qualites.libelleFonction")
        // ->where("date_pointage","!=","$dateNow")
        // ->groupBy("employees.id","nom","prenom","qualite_id","qualites.libelleFonction")->latest("p_persones.created_at")
        // ->get();
        // return \response()->json([
        //     "data"=>$data,
        //     "status"=>1,
        // ]);

        $dateNow = Carbon::now()->format('Y-m-d');
        $toDayPoint = P_persone::where("date_pointage","=","$dateNow")->select('id_employee')->get();
        $arrayExcept = [];
        foreach($toDayPoint as $item){
            $arrayExcept[]=$item->id_employee;
        }
        $data = Employee::leftjoin("qualites","qualites.id","=","employees.qualite_id")
        ->select("employees.id","nom","prenom","qualites.libelleFonction")
        ->whereNotIn("employees.id",$arrayExcept)
        ->latest("employees.created_at")
        ->get();
          return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $dateNow = Carbon::now()->format('Y-m-d');
        P_persone::create([
            'id_employee' => $request->id_employee,
            'presence' => $request->presence,
            'heurs_suppl' => $request->heurs_suppl,
            'remarque' => $request->remarque,
            'date_pointage' => $dateNow ,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\P_persone  $p_persone
     * @return \Illuminate\Http\Response
     */
    public function show(P_persone $p_persone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\P_persone  $p_persone
     * @return \Illuminate\Http\Response
     */
    public function edit(P_persone $p_persone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\P_persone  $p_persone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $P_persone =  P_persone::where('id', $request->id)->first();
        $P_persone->fill($request->all());
        $P_persone->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\P_persone  $p_persone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= P_persone::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
