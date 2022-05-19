<?php

namespace App\Http\Controllers;

use App\Models\Administratif;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;

class AdministratifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Administratif:: join("materiels","materiels.id","=","administratifs.id_materiel")
        // ->join("materiels","accidents.id_materiel","=","materiels.id")
        ->select("descriptionA","administratifs.id","marqueM","documentA")
        ->latest("administratifs.created_at")->get();
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
        if($request->file('documentA')){
            $ext = strtolower($request->file('documentA')->getClientOriginalExtension());
        $imageNmae = md5("00".Str::random(45));
        if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
        {            
             $request->file('documentA')->storeAs('images', $fileName.".".$ext, 'public'); 
             $image = '/storage/images/'.$fileName.".".$ext ;
        }
        }
        Administratif::create([
            'descriptionA' => $request->descriptionA,
            'id_materiel' => $request->id_materiel,
            'documentA' => $image,
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
     * @param  \App\Models\Administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Administratif::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function edit(Administratif $administratif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Administratif = Administratif::where("id","=",$request->id)->first();
        if($Administratif){

            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = $Administratif->documentA ;
            if($request->file('documentA')){
                $ext = strtolower($request->file('documentA')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
                    if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
                    {            
                        $request->file('documentA')->storeAs('images', $fileName.".".$ext, 'public'); 
                        $image = '/storage/images/'.$fileName.".".$ext ;
                    }
            }
        
            $Administratif =  Administratif::where('id', $request->id)->first();
            $Administratif->descriptionA=$request->descriptionA;
            $Administratif->id_materiel=$request->id_materiel;
            $Administratif->documentA=$image;

            $Administratif->save();
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
     * @param  \App\Models\Administratif  $administratif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Administratif::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
