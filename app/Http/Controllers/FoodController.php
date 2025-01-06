<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    // for converting the data to json format
    public function index(){
        
        return Food::all();
    }
    // for showing the data using id
    public function show($id){
        
        return Food::findOrFail($id);
    }
    // for storing the data
    public function store(Request $request){
        
        $food = Food::create($request->all());
        return response()->json($food, 201);
    }
    // for updating the data
    public function update(Request $request, $id){

        $food = Food::findOrFail($id);
        $food->update($request->all());
        return response()->json($food, 200);
    }

    // for deleting the data
    public function destroy($id){
        
        $food = Food::findOrFail($id);
        $food->delete();
        return response()->json(null, 204);
    }
}
