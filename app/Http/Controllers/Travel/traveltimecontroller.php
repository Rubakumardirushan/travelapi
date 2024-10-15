<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travledate;
use App\Models\Travletime;
use Illuminate\Support\Facades\Validator;

class traveltimecontroller extends Controller
{
    public function index()
    {
    
        $traveltime = Travletime::all();

        
        return response()->json($traveltime, 200);
    }


    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'traveltime' => 'required|date_format:H:i',
            'traveldate_id' => 'required', 
        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        
        $check = Travledate::find($request->traveldate_id);
        if (!$check) {
            return response()->json(['error' => 'Travel date not found.'], 404);
        }

        
        $existingTime = Travletime::where('traveldate_id', $request->traveldate_id)
            ->where('traveltime', $request->traveltime)
            ->first();

        
        if ($existingTime) {
            return response()->json(['error' => 'Travel time already exists for this travel date.'], 409);
        }

        
        $traveltime = new Travletime();
        $traveltime->traveltime = $request->traveltime;
        $traveltime->traveldate_id = $request->traveldate_id;
        $traveltime->save(); 

        
        return response()->json($traveltime, 201);
    }
    
 
    public function show($id)
    {
        
        $travledate = Travledate::find($id);
    
        
        if (!$travledate) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => ['traveldate_id' => ['The selected travel_date_id is invalid.']], // Corrected the key here
            ], 422);
        }
    
        
        $traveltimes = Travletime::where('traveldate_id', $id)->get();
    
        
        if ($traveltimes->isEmpty()) {
            return response()->json([
                'message' => 'No travel times found for the selected travel date.',
            ], 404);
        }
    
        
        return response()->json($traveltimes, 200);
    }
    




}
    





