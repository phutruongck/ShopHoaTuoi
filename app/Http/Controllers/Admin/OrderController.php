<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;

class OrderController extends Controller
{
    public function index()
    {
        return View('admin.order.index');
    }

    public function getListOrder()
    {
        $list = \DB::table('orders')
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->where('orders.data', '=', 'user')
            ->select('users.name as user_name', 'products.name as product_name', 'orders.qty as quantity', 'orders.amount as amount', 'products.image_link', 'orders.created_at')
            ->get();
//        $list = Order::with('products', '')->get();
        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }
}
