<?php

namespace App\Http\Controllers;
use App\Models\Chantier;
use Illuminate\Http\Request;

class ChantierController extends Controller
{
    public function index(Request $request){
        $data = Chantier::limit(10)->get();
        return \response()->json([
            "data"=>$data,
            "status"=>1,
        ]);
    }
}
