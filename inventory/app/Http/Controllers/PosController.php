<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Arr;

class PosController extends Controller
{
    public function getProduct($id)
    {
        $product = DB::table('products')
            ->where('category_id', $id)
            ->get();
        return response()->json($product);
    }
    public function orderDone(Request $request)
    {
        $validatedata = $request->validate([
            'customer_id' => 'required',
            'payby' => 'required',
        ]);
        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['qty'] = $request->qty;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['pay'] = $request->pay;
        $data['due'] = $request->due;
        $data['payby'] = $request->payby;
        $data['order_date'] = date('d/m/y');
        $data['order_month'] = date('F');
        $data['order_year'] = date('Y');

        $order_id = DB::table('orders')->insertGetId($data);

        $contents = DB::table('carts')->get();
        $odata = array();
        foreach ($contents as $content) {
            $odata['order_id'] = $order_id;
            $odata['product_id'] = $content->pro_id;
            $odata['pro_quantity'] = $content->pro_quantity;
            $odata['product_price'] = $content->pro_price;
            $odata['sub_total'] = $content->pro_subtotal;
            DB::table('order_details')->insert($odata);

            DB::table('products')->where('id', $content->pro_id)
                ->update(['product_quantity' => DB::raw('product_quantity -' . $content->pro_quantity)]);
        }
        DB::table('carts')->delete();
        return response('done');
    }

    //home
    public function todaySell()
    {
        $date = date('d/m/y');
        $sell = DB::table('orders')->where('order_date', $date)->sum('total');
        return response()->json($sell);
    }
    public function todayIncome()
    {
        $date = date('d/m/y');
        $income = DB::table('orders')->where('order_date', $date)->sum('pay');
        return response()->json($income);
    }
    public function todayDue()
    {
        $date = date('d/m/y');
        $due = DB::table('orders')->where('order_date', $date)->sum('due');
        return response()->json($due);
    }
    public function expense()
    {
        $date = date('d/m/y');
        $expense = DB::table('expenses')->where('expense_date', $date)->sum('amount');
        return response()->json($expense);
    }
    public function stockout()
    {
        $product = DB::table('products')->where('product_quantity', '<', '1')->get();
        return response()->json($product);
    }
}
