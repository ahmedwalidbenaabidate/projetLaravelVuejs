<?php

namespace App\Http\Controllers;

use App\Models\Carburant;
use Illuminate\Http\Request;

class CarburantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Carburant::join("materiels","materiels.id","=","carburants.id_materiel")
        ->join("type_materiels","type_materiels.id","=","materiels.typeMateriel_id")
        ->select("carburants.id","marqueM","libelleMateriel","etatM","quantiteC","typeC","dateC","observation")->latest("carburants.created_at")->get();
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
        Carburant::create([
            'id_materiel' => $request->id_materiel,
            'quantiteC' => $request->quantiteC,
            'typeC' => $request->typeC,
            'dateC' => $request->dateC,
            'observation' => $request->observation,        
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
     * @param  \App\Models\Carburant  $carburant
     * @return \Illuminate\Http\Response
     */
    public function show(Carburant $carburant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carburant  $carburant
     * @return \Illuminate\Http\Response
     */
    public function edit(Carburant $carburant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carburant  $carburant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carburant $carburant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carburant  $carburant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Carburant::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
