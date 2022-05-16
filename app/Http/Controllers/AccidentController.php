<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;

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
        ->select("description","accidents.id","reference","nom","prenom","dateA","marqueM","proceV")
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
    public function create(Request $request)
    {
            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = "/storage/images/imgDoc1.png" ;
            if($request->file('proceV')){
                $ext = strtolower($request->file('proceV')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
            if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
            {            
                 $request->file('proceV')->storeAs('images', $fileName.".".$ext, 'public'); 
                 $image = '/storage/images/'.$fileName.".".$ext ;
            }
            }
            Accident::create([
                'description' => $request->description,
                'id_employee' => $request->id_employee,
                'dateA' => $request->dateA,
                'id_materiel' => $request->id_materiel,
                'proceV' => $image,
            ]);
            return \response()->json([
                "status"=>1,
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
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Accident::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
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
    public function update(Request $request)
    {
        $Accident = Accident::where("id","=",$request->id)->first();
        if($Accident){

            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = $Accident->proceV ;
            if($request->file('proceV')){
                $ext = strtolower($request->file('proceV')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
                    if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
                    {            
                        $request->file('proceV')->storeAs('images', $fileName.".".$ext, 'public'); 
                        $image = '/storage/images/'.$fileName.".".$ext ;
                    }
            }
        
            $Accident =  Accident::where('id', $request->id)->first();
            $Accident->description=$request->description;
            $Accident->id_employee=$request->id_employee;
            $Accident->dateA=$request->dateA;
            $Accident->id_materiel=$request->id_materiel;
            $Accident->proceV=$image;

            $Accident->save();
            return \response()->json([
                "status"=>1,
                "image"=> $image
            ]);
            }
            else
            return \response()->json([
                "status"=>-2,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accident  $accident
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Accident::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
