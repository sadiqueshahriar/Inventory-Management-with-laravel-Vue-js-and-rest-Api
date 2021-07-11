<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
    public function todayOrders()
    {
        $date = date('d/m/y');
        $order = DB::table('orders')->join('customers', 'orders.customer_id', 'customers.id')
            ->where('order_date', $date)
            ->select('customers.name', 'orders.*')
            ->orderBy('orders.id', 'DESC')->get();
        return response()->json($order);
    }
    public function orderDetails($id)
    {
        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->where('orders.id', $id)
            ->select('customers.name', 'customers.phone', 'customers.address', 'orders.*')
            ->first();
        return response()->json($order);
    }
    public function orderDetailsAll($id)
    {
        $details = DB::table('order_details')
            ->join('products', 'order_details.product_id', 'products.id')
            ->where('order_details.order_id', $id)
            ->select('products.product_name', 'products.product_code', 'products.image', 'order_details.*')
            ->get();
        return response()->json($details);
    }

    public function searchOrderDate(Request $request)
    {
        $orderdate = $request->date;
        $newdate = new DateTime($orderdate);
        $done = $newdate->format('d/m/y');

        $order = DB::table('orders')
            ->join('customers', 'orders.customer_id', 'customers.id')
            ->select('customers.name', 'orders.*')
            ->where('orders.order_date', $done)
            ->get();
        return response()->json($order);
    }
}
