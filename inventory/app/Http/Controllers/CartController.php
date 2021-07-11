<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $check = DB::table('carts')->where('pro_id', $id)->first();
        if ($check) {
            DB::table('carts')->where('pro_id', $id)->increment('pro_quantity');

            $product = DB::table('carts')->where('id', $id)->first();
            $sub_total = $product->pro_quantity * $product->pro_price;
            DB::table('carts')->where('pro_id', $id)->update(['pro_subtotal' => $sub_total]);
        } else {
            $data = array();
            $data['pro_id'] = $id;
            $data['pro_name'] = $product->product_name;
            $data['pro_quantity'] = 1;
            $data['pro_price'] = $product->selling_price;
            $data['pro_subtotal'] = $product->selling_price;

            DB::table('carts')->insert($data);
        }
    }

    public function cartProduct()
    {
        $cart = DB::table('carts')->get();
        return response()->json($cart);
    }
    public function cartDelete($id)
    {
        $cart = DB::table('carts')->where('id', $id)->delete();
    }
    public function increment($id)
    {
        $quantity =  DB::table('carts')->where('id', $id)->increment('pro_quantity');
        $product = DB::table('carts')->where('id', $id)->first();
        $sub_total = $product->pro_quantity * $product->pro_price;
        DB::table('carts')->where('id', $id)->update(['pro_subtotal' => $sub_total]);
        return response('done');
    }
    public function decrement($id)
    {
        $quantity =  DB::table('carts')->where('id', $id)->decrement('pro_quantity');
        $product = DB::table('carts')->where('id', $id)->first();
        $sub_total = $product->pro_quantity * $product->pro_price;
        DB::table('carts')->where('id', $id)->update(['pro_subtotal' => $sub_total]);
        return response('done');
    }

    public function Vat()
    {
        $vat = DB::table('vats')->first();
        return response()->json($vat);
    }
}
