<?php

namespace App\Http\Controllers;

use App\Models\AffectationMateriel;
use Illuminate\Http\Request;

class AffectationMaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AffectationMateriel:: join("employees","affectation_materiels.id_employee","=","employees.id")
        ->join("materiels","affectation_materiels.id_materiel","=","materiels.id")
        ->select("affectation_materiels.id","reference","nom","prenom","date_debut","date_fin","marqueM","statut")
        ->latest("affectation_materiels.created_at")->get();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }


    public function indexAfficherPointParDate($date_pointage)
    {
        $data = AffectationMateriel::join("employees","employees.id","=","affectation_materiels.id_employee")
        ->join("materiels","affectation_materiels.id_materiel","=","materiels.id")
        ->select("affectation_materiels.id","reference","nom","prenom","date_debut","date_fin","marqueM","statut")
        ->where("date_debut","=","$date_pointage")
        ->latest("affectation_materiels.created_at")
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
        AffectationMateriel::create([
            'id_employee' => $request->id_employee,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'id_materiel' => $request->id_materiel,
            'statut' => "pas encore",         
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
     * @param  \App\Models\AffectationMateriel  $affectationMateriel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= AffectationMateriel::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AffectationMateriel  $affectationMateriel
     * @return \Illuminate\Http\Response
     */
    public function edit(AffectationMateriel $affectationMateriel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AffectationMateriel  $affectationMateriel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $AffectationMateriel =  AffectationMateriel::where('id', $request->id)->first();
        $AffectationMateriel->fill($request->all());
        $AffectationMateriel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AffectationMateriel  $affectationMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= AffectationMateriel::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
