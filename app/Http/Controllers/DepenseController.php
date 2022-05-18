<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;

class DepenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Depense:: join("employees","depenses.id_employee","=","employees.id")
        ->leftjoin("materiels","depenses.id_materiel","=","materiels.id")
        ->select("description","depenses.id","reference","nom","prenom","dateDepense","id_materiel","marqueM","totalTCC","bonDepense")
        ->latest("depenses.created_at")->get();
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
            if($request->file('bonDepense')){
                $ext = strtolower($request->file('bonDepense')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
            if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
            {            
                 $request->file('bonDepense')->storeAs('images', $fileName.".".$ext, 'public'); 
                 $image = '/storage/images/'.$fileName.".".$ext ;
            }
            }
            Depense::create([
                'description' => $request->description,
                'id_employee' => $request->id_employee,
                'dateDepense' => $request->dateDepense,
                'id_materiel' => $request->id_materiel,
                'totalTCC' => $request->totalTCC,
                'bonDepense' => $image,
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
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= Depense::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function edit(Depense $depense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $Depense = Depense::where("id","=",$request->id)->first();
        if($Depense){

            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = $Depense->bonDepense ;
            if($request->file('bonDepense')){
                $ext = strtolower($request->file('bonDepense')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
                    if($ext=="pdf" || $ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="docx" || $ext=="rar" || $ext=="zip")
                    {            
                        $request->file('bonDepense')->storeAs('images', $fileName.".".$ext, 'public'); 
                        $image = '/storage/images/'.$fileName.".".$ext ;
                    }
            }
        
            $Depense =  Depense::where('id', $request->id)->first();
            $Depense->description=$request->description;
            $Depense->id_employee=$request->id_employee;
            $Depense->dateDepense=$request->dateDepense;
            $Depense->id_materiel=$request->id_materiel;
            $Depense->totalTCC=$request->totalTCC;
            $Depense->bonDepense=$image;

            $Depense->save();
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
     * @param  \App\Models\Depense  $depense
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= Depense::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
