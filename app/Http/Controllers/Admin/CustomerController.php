<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return View('admin.customer.index');
    }

    public function getListCustomer()
    {
        $list = \DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->join('customers', 'customers.id', '=', 'orders.user_id')
            ->where('orders.data', '=', 'customer')
            ->select('customers.name as customer_name', 'products.name as product_name', 'orders.qty as quantity', 'orders.amount as amount', 'products.image_link', 'orders.created_at', 'customers.address', 'customers.tel')
            ->get();
//        $list = Order::with('products', '')->get();
        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }
}
