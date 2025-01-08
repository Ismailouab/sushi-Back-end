<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Food;
class OrderController extends Controller
{
    // for converting the data to json format
    public function index(){

        return Order::all();
    }
    // for showing the data using id
    public function show($id){

        return Order::findOrFail($id);
    }
    // for storing the data
    public function store(Request $request){

        // Retrieve the food price from the 'foods' table
        $food = Food::findOrFail($request->food_id);
        
        // Calculate the total price based on the food price and quantity
        $totalPrice = $food->price * $request->quantity;

        // Create the order with the calculated total price
        $order = Order::create([
            'user_id' => $request->user_id,
            'food_id' => $request->food_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice, // Dynamically calculated
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json($order, 201);
    }
    // for updating the data
    public function update(Request $request, $id){

        $order = Order::findOrFail($id);

        // Retrieve the food price from the 'foods' table
        $food = Food::findOrFail($request->food_id);
        
        // Calculate the total price based on the food price and quantity
        $totalPrice = $food->price * $request->quantity;

        // Update the order with the calculated total price
        $order->update([
            'user_id' => $request->user_id,
            'food_id' => $request->food_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice, // Dynamically calculated
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return response()->json($order, 200);
    }
    // for deleting the data
    public function destroy($id){

        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
