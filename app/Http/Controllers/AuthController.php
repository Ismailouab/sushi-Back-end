<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Role;
class AuthController extends Controller{

    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
         // Check if the user exists and the credentials are correct
        $user = Users::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }

   
    public function register(Request $request){
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed', 
        ]);

         // Fetch the 'client' role by name
        $role = Role::where('name', 'client')->first();  

        if (!$role) {
            return response()->json(['error' => 'Role not found'], 400);
        }

        // Create the user
        $user = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  
        ]);

         // Assign the 'client' role to the user
        $user->role()->associate($role);
        $user->save();

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['token' => $token], 201);  // Return the token as a response
    }
    public function logout(Request $request){
            // Revoke the token that was used to authenticate the current request...
            $request->user()->currentAccessToken()->delete();
            return response()->json(['message' => 'Token deleted'], 200);
    }

}
