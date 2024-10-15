<?php

namespace App\Http\Controllers\Travel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Travlemode;
use App\Models\Travledate;


class traveldatecontroller extends Controller
{
    public function index()
    {
    
        $traveldate = Travledate::all();
        return response()->json($traveldate, 200);
    }
    
    

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'traveldate' => 'required|date',
            'travel_modes_id' => 'required|integer', 
        ]);

        
        $travlemode = Travlemode::where('id', $validatedData['travel_modes_id'])->first();

        if (!$travlemode) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => ['travel_modes_id' => ['The selected travel_modes_id is invalid.']],
            ], 422);
        }

        
        $existingTravelDate = Travledate::where('traveldate', $validatedData['traveldate'])
        ->where('travel_modes_id', $validatedData['travel_modes_id'])
        ->first();

    if ($existingTravelDate) {
        return response()->json([
            'message' => 'Validation Error',
            'errors' => [
                'traveldate' => ['The travel date with the selected travel mode already exists.']
            ],
        ], 422);
    }
        
        $traveldate = Travledate::create([
            'traveldate' => $validatedData['traveldate'],
            'travel_modes_id' => $validatedData['travel_modes_id'],
        ]);

        
        return response()->json($traveldate, 201);
    }

    
    public function show($id)
    {
        
        $travlemode = Travlemode::find($id);
    
        if (!$travlemode) {
            return response()->json([
                'message' => 'Validation Error',
                'errors' => ['travel_modes_id' => ['The selected travel_modes_id is invalid.']],
            ], 422);
        }
    
    
        $travledates = Travledate::where('travel_modes_id', $id)->get();
    
        
        if ($travledates->isEmpty()) {
            return response()->json([
                'message' => 'No travel dates found for the selected travel mode.',
            ], 404);
        }
    
        
        return response()->json($travledates, 200);
    }
    





}
