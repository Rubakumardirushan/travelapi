<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travlemode;
use Illuminate\Support\Facades\Validator;

class travelcontroller extends Controller
{
    public function index(){

        $travelmode = Travlemode::all();
        return response()->json($travelmode, 200);

    }
    

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:travlemodes,name',
        ]);

        
        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

    
        $travelmode = Travlemode::create([
            'name' => $request->input('name'), 
        ]);

        return response()->json($travelmode, 201);
    }
   





    }





