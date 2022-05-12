<?php

namespace App\Http\Controllers;

use App\Models\TypeMateriel;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;
class ControllerTypeMateriel extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TypeMateriel:: latest()->get();
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
        $test = TypeMateriel::where("libelleMateriel","=",$request->libelleMateriel)->first();
        if(!$test){

            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = "/storage/images/image10.png" ;
            if($request->file('photo')){
                $ext = strtolower($request->file('photo')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
            if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="jpeg"  )
            {            
                 $request->file('photo')->storeAs('images', $fileName.".".$ext, 'public'); 
                 $image = '/storage/images/'.$fileName.".".$ext ;
            }
            }
            TypeMateriel::create([
                'libelleMateriel' => $request->libelleMateriel,
                'photo' => $image,
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
     * @param  \App\Models\TypeMateriel  $typeMateriel
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= TypeMateriel::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeMateriel  $typeMateriel
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeMateriel $typeMateriel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeMateriel  $typeMateriel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $test = TypeMateriel::where("libelleMateriel","=",$request->libelleMateriel)
        ->where('id',"!=",$request->id)->first();
        if($test)
        return \response()->json([
            "status"=>-1,
        ]);

        $TypeMateriel = TypeMateriel::where("id","=",$request->id)->first();
        if($TypeMateriel){

            $requestData = $request->all();
            $fileName = \md5(Str::random(45));
            $image = $TypeMateriel->photo ;
            if($request->file('photo')){
                $ext = strtolower($request->file('photo')->getClientOriginalExtension());
            $imageNmae = md5("00".Str::random(45));
                    if($ext=="png" || $ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="jpeg"  )
                    {            
                        $request->file('photo')->storeAs('images', $fileName.".".$ext, 'public'); 
                        $image = '/storage/images/'.$fileName.".".$ext ;
                    }
            }
        
            $TypeMateriel =  TypeMateriel::where('id', $request->id)->first();
            $TypeMateriel->libelleMateriel=$request->libelleMateriel;
            $TypeMateriel->photo=$image;

            $TypeMateriel->save();
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
     * @param  \App\Models\TypeMateriel  $typeMateriel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= TypeMateriel::where('id',$id)->first();
        $data->delete();
        return \response()->noContent();
    }
}
