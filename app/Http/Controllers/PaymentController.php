<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Customer;
use Session;

class PaymentController extends Controller
{
    public function index()
    {
        return view('pay.index');
    }

    public function submitPayment(Request $request)
    {
        $isUser = $request['isUser'];

        if ($isUser == 1) {
            $carts = Session::get('cart');

            foreach ($carts->items as $item) {
                Order::create([
                    'product_id' => $item['item']->id,
                    'user_id' => \Auth::user()->id,
                    'qty' => $item['qty'],
                    'amount' => $item['price'],
                    'data' => 'user',
                    'status' => true
                ]);
            }

            Session::forget('cart');

            return response()->json([
                'status' => 'success',
                'data' => 'Thanh toán thành công'
            ]);
        } else {
            $carts = Session::get('cart');

            $customer = Customer::create([
                'name' => $request['name'],
                'birthday' => $request['birthday'],
                'address' => $request['address'],
                'provinces_id' => $request['province'],
                'tel' => $request['tel'],
                'email' => $request['email'],
            ]);

            foreach ($carts->items as $item) {
                Order::create([
                    'product_id' => $item['item']->id,
                    'user_id' => $customer->id,
                    'qty' => $item['qty'],
                    'amount' => $item['price'],
                    'data' => 'customer',
                    'status' => true
                ]);
            }

            Session::forget('cart');

            return response()->json([
                'status' => 'success',
                'data' => 'Thanh toán thành công'
            ]);
        }
    }

    public function completedPayment()
    {
        if (!Session::has('cart')) {
            return view('pay.completed');
        }
    }
}
