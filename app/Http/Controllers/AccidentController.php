<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Accident:: join("employees","accidents.id_employee","=","employees.id")
        ->join("materiels","accidents.id_materiel","=","materiels.id")
        ->select("description","reference","nom","prenom","dateA","marqueM","proceV")
        ->latest("accidents.created_at")->get();
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
    public function create()
    {
        //
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
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function show(Accident $accident)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function edit(Accident $accident)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Accident $accident)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function destroy(Accident $accident)
    {
        //
    }
}
