<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    // Check if the user is admin
    private function isAdmin($id)
    {
        return Auth::id() === 1 && (int)$id === 1;
    }

    // Get all foods
    public function index()
    {
        $foods = Food::all();
        return response()->json($foods);
    }

    // Show a specific food by ID
    public function show($id)
    {
        $food = Food::find($id);
        if ($food) {
            return response()->json($food);
        }
        return response()->json(['message' => 'Food not found'], 404);
    }

    // Store a new food item
    public function store(Request $request, $id)
    {
        if (!$this->isAdmin($id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'rating' => 'nullable|numeric|min:0|max:5',      
        ]);

        $food = Food::create($validated);
        return response()->json($food, 201);
    }

    // Update a food item
    public function update(Request $request, $id, Food $food)
    {
        if (!$this->isAdmin($id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'image' => 'nullable|string',
            'category_id' => 'sometimes|required|exists:categories,id', 
            'rating' => 'nullable|numeric|min:0|max:5',                 
        ]);

        $food->update($validated);
        return response()->json($food, 200);
    }

    // Delete a food item
    public function destroy($id, Food $food)
    {
        if (!$this->isAdmin($id)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $food->delete();
        return response()->json(['message' => 'Food deleted successfully'], 200);
    }
}
