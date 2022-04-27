<?php

namespace App\Http\Controllers;
use App\Models\Chantier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ChantierResource;

class ChantierController extends Controller
{
    public function index(Request $request){
        $data = Chantier:: latest()->get();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    public function create(Request $request)
    {
        Chantier::create([
            'code' => $request->code,
            'libelle' => $request->libelle,
            'abreviation' => $request->abreviation,
        ]);
    }

    public function show($id)
    {
        // ChantierResource::collection(Chantier:: latest()->get());
        $data= Chantier::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    public function update(Request $request)
    {
        $Chantier =  Chantier::where('id', $request->id)->first();
        $Chantier->fill($request->all());
        $Chantier->save();
    }

    public function destroy($id):Response
    {
        $data= Chantier::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }

}
