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

        $product_id = rand(1,3);
        $user_id = rand(1,3);
        $quantity = rand(1,5);

        $returnJson = false;

        if ($request->product_id){
            $product_id = $request->product_id;
        }

        if ($request->quantity){
            $quantity = $request->quantity;
        }

        if ($request->user()){
            $user_id = $request->user()->id;
        }
        
        //set validation
        if ($request->product_id || $request->quantity){

            $returnJson = True;
            $validator = Validator::make($request->all(), [
                'product_id'      => 'required',
                'quantity'  => 'required|numeric|min:1'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        }

        $product = $this->checkStock($product_id, $quantity);

        if ($product['available']){
            $orders = Orders::create([
                'product_id' => $product_id,
                'quantity' => $quantity,
                'user_id' => $user_id,
                'total_prices' => $product['price'] * $quantity
            ]);

            if ($orders) {
                Products::where('id', $product_id)->update(['stock' => $product['stock'] - $quantity]);
            }

            if ($returnJson){
                return response()->json([
                    'success' => true,
                    'message' => 'order created'
                ], 200);
            } else {
                echo "order product id " . $product_id . " created "; echo "\n";
            }
        } else {

            if ($returnJson){
                return response()->json([
                    'success' => false,
                    'message' => 'stock unavailable, stock hanya sisa ' . $product['stock']
                ], 401);  
            } else {
                echo "stock product id " . $product_id . " unavailable, stock hanya sisa " . $product['stock']; echo "\n";
            }
        }
    }

    public function checkStock ($id, $quantity){

        $product = Products::Where('id', '=', $id)->first();

        if ($product['stock'] >= $quantity){
            $product['available'] = true;
        } else {
            $product['available'] = false;
        }

        return $product;
    }
}
