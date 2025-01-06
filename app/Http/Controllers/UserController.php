<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // for converting the data to json format
    public function index(){

        return Users::with('role')->get();  // Return users with their roles
    }
    // for showing the data using id
    public function show($id){
        
        return Users::with('role')->findOrFail($id);
    }
    // for storing the data
    public function store(Request $request){

        $user = Users::create($request->all());
        return response()->json($user, 201);
    }
    // for updating the data
    public function update(Request $request, $id){
        
        $user = Users::findOrFail($id);
        $user->update($request->all());
        return response()->json($user, 200);
    }
    // for deleting the data
    public function destroy($id){

        $user = Users::findOrFail($id);
        $user->delete();
        return response()->json(null, 204);
    }
}
