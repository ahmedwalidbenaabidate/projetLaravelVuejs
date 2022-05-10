<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Materiel::leftjoin("type_materiels","type_materiels.id","=","materiels.typeMateriel_id")->select("materiels.*","type_materiels.libelleMateriel")->latest()->get();
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
        Materiel::create([
            'marqueM' => $request->marqueM,
            'modelM' => $request->modelM,
            'etatM' => $request->etatM,
            'date_AchatM' => $request->date_AchatM,
            'date_FonctionM' => $request->date_FonctionM,
            'typeMateriel_id' => $request->typeMateriel_id,
                    
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
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Materiel::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function edit(Materiel $materiel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Materiel =  Materiel::where('id', $request->id)->first();
        $Materiel->fill($request->all());
        $Materiel->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Materiel  $materiel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Materiel::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
