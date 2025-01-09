<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    // for converting the data to json format
    public function index(){

        $categories = Category::all();
        return response()->json($categories);
    }
    // for storing the data
    public function store(Request $request){

        $validated = $request->validate(['name' => 'required|string|max:255']);
        $category = Category::create($validated);

        return response()->json($category, 201);
    }
    // for showing the data
    public function show($id){
            
        $category = Category::find($id);
        if ($category) {
            return response()->json($category);
        }
        return response()->json(['message' => 'Category not found'], 404);
    }
    // for updating the data
    public function update(Request $request, Category $category){

        $validated = $request->validate(['name' => 'required|string|max:255']);
        $category->update($validated);
        return response()->json($category);
    }
    // for deleting the data
    public function destroy(Category $category){

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
