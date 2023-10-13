<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Facades\Validator;

class OrdersController extends Controller
{
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'product_id'      => 'required',
            'quantity'  => 'required|numeric|min:1'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Products::Where('id', '=', $request->product_id)->first();

        if ($product['stock'] >= $request->quantity){
            $orders = Orders::create(array_merge($request->only('product_id', 'quantity'),[
                'user_id' => $request->user()->id,
                'total_prices' => $product['price'] * $request->quantity
            ]));

            if ($orders) {
                Products::where('id', $request->product_id)->update(['stock' => $product['stock'] - $request->quantity]);
            }

            return response()->json([
                'success' => true,
                'message' => 'order created'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'stock unavailable, stock hanya sisa ' . $product['stock']
            ], 401);    
        }
    }
}
