<?php

namespace App\Http\Controllers;

use App\Models\Qualite;
use Illuminate\Http\Request;

class QualiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Qualite:: latest()->get();
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
        // dd($request);
        $test = Qualite::where("libelleFonction","=",$request->libelleFonction)->first();
        if(!$test){
            Qualite::create([
                'libelleFonction' => $request->libelleFonction,
            ]);
            return \response()->json([
                "status"=>1,
            ]);
        }
        else
        return \response()->json([
            "status"=>-1,
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
     * @param  \App\Models\Qualite  $qualite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Qualite::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Qualite  $qualite
     * @return \Illuminate\Http\Response
     */
    public function edit(Qualite $qualite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Qualite  $qualite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $test = Qualite::where("libelleFonction","=",$request->libelleFonction)->first();
        if(!$test){
            $Qualite =  Qualite::where('id', $request->id)->first();
            $Qualite->fill($request->all());
            $Qualite->save();
            return \response()->json([
                "status"=>1,
            ]);
        }
        else
        return \response()->json([
            "status"=>-1,
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Qualite  $qualite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Qualite::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
