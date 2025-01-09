<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Food;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    // for converting the data to json format
    public function index(){

        return Order::all();
    }
    // for showing the data using id
    public function show($id){

        try {
            // Load the order with related food data from 'food_order' and detailed order items from 'order_items'
            $order = Order::with(['foods', 'orderItems.food'])->findOrFail($id);
    
            // Return the order with its associated foods and order items
            return response()->json($order, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getOrdersByUserId($userId)
{
    try {
        // Fetch all orders for the given user ID, including associated foods
        $orders = Order::where('user_id', $userId)
            ->with(['food', 'orderItems.food']) // Eager load related data
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user.'], 404);
        }

        return response()->json($orders, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
    // for storing the data
    public function store(Request $request, $userId)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'foods' => 'required|array',
                'foods.*.food_name' => 'required|string|exists:foods,name',
                'foods.*.quantity' => 'required|integer|min:1',
                'status' => 'required|string|in:pending,completed,canceled',
            ]);
    
            // Create the order for the specified user
            $order = Order::create([
                'user_id' => $userId,
                'status' => $request->status,
                'total_price' => 0,
            ]);
    
            $totalPrice = 0;
    
            // Add foods to the order
            foreach ($request->foods as $foodData) {
                $food = Food::where('name', $foodData['food_name'])->first();
                $foodTotalPrice = $food->price * $foodData['quantity'];
                $totalPrice += $foodTotalPrice;
    
                $order->food()->attach($food->id, [
                    'quantity' => $foodData['quantity'],
                    'total_price' => $foodTotalPrice,
                ]);
    
                $order->orderItems()->create([
                    'food_id' => $food->id,
                    'quantity' => $foodData['quantity'],
                    'total_price' => $foodTotalPrice,
                ]);
            }
    
            // Update the total price
            $order->update(['total_price' => $totalPrice]);
    
            return response()->json($order->load('food', 'orderItems.food'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    // for updating the data
    public function update(Request $request, $userId, $id)
{
    try {
        // Validate the request data
        $request->validate([
            'foods' => 'required|array',
            'foods.*.food_name' => 'required|string|exists:foods,name',
            'foods.*.quantity' => 'required|integer|min:1',
            'status' => 'required|string|in:pending,completed,canceled',
        ]);

        // Find the order by ID and check if it belongs to the specified user
        $order = Order::where('user_id', $userId)->findOrFail($id);

        // Clear existing items from the order (in the pivot table)
        $order->food()->detach();

        $totalPrice = 0;  // Initialize total price

        // Loop through the foods array to add each food item again (or update)
        foreach ($request->foods as $foodData) {
            // Get the food by its name
            $food = Food::where('name', $foodData['food_name'])->first();

            if (!$food) {
                return response()->json(['error' => 'Food item not found: ' . $foodData['food_name']], 404);
            }

            // Calculate the total price for this food item
            $foodTotalPrice = $food->price * $foodData['quantity'];
            $totalPrice += $foodTotalPrice;

            // Attach the food item to the order in the pivot table
            $order->food()->attach($food->id, [
                'quantity' => $foodData['quantity'],
                'total_price' => $foodTotalPrice,
            ]);
        }

        // Update the total price of the order (optional)
        $order->update(['total_price' => $totalPrice, 'status' => $request->status]);

        // Return the updated order with its items
        return response()->json($order->load('food'), 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    // for deleting the data
    public function destroy($userId, $id){
    try {
        // Find the order by ID and check if it belongs to the specified user
        $order = Order::where('user_id', $userId)->findOrFail($id);

        // Detach from food_order pivot table and delete order items
        $order->food()->detach(); // Detach from food_order pivot table
        $order->orderItems()->delete(); // Delete from order_items table
        $order->delete(); // Delete the order

        return response()->json(['message' => 'Order deleted successfully'], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}
