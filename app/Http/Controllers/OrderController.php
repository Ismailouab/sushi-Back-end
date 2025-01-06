<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

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

        $order = Order::create($request->all());
        return response()->json($order, 201);
    }
    // for updating the data
    public function update(Request $request, $id){

        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order, 200);
    }
    // for deleting the data
    public function destroy($id){

        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }
}
