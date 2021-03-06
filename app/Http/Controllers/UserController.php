<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User:: latest()->get();
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
        $test = User::where("email","=",$request->email)->first();
        if(!$test){
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data= User::where('id',$id)->first();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $User =  User::where('id', $request->id)->first();
            if(!$User)
            return \response()->json([
                "status"=>-1,
            ]);
            $User->name = $request->name;
            if($request->password!="")
              $User->password = Hash::make($request->password);
            $User->save();
            return \response()->json([
                "status"=>1,
            ]);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= User::where('id',$id)->first();
        if(!$data)
            return \response()->json([
                "status"=>-1,
            ]);
        $data->delete();
        return \response()->json([
            "status"=>1,
        ]);
    }
}
