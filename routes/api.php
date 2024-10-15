<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Travel\travelcontroller;
use App\Http\Controllers\Travel\traveldatecontroller;
use App\Http\Controllers\Travel\traveltimecontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// travel mode
Route::get('travel',[travelcontroller::class,'index']);
Route::post('travel',[travelcontroller::class,'store']);

//travle date
Route::get('traveldate',[traveldatecontroller::class,'index']);
Route::post('traveldate',[traveldatecontroller::class,'store']);
Route::get('traveldate/{id}',[traveldatecontroller::class,'show']);


//travle time
Route::get('traveltime',[traveltimecontroller::class,'index']);
Route::post('traveltime',[traveltimecontroller::class,'store']);
Route::get('traveltime/{id}',[traveltimecontroller::class,'show']);