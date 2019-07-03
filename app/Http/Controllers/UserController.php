<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use Auth;

class UserController extends Controller
{
    public function __contruct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.index');
    }

    public function getUser()
    {
        if (Auth::check()) {
            return response()->json([
                'status' => 'success',
                'data' => Auth::user()
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Bạn chưa đăng nhập'
            ]);
        }
    }

    public function infoPayment()
    {
        return view('user.infoPayment');
    }

    public function getInfoPayment()
    {
        if (Auth::check()) {
            try {
                $data_payment = Auth::user();

                return response()->json([
                    'status' => 'success',
                    'data' => $data_payment
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'data' => $e
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Bạn chưa đăng nhập'
            ]);
        }
    }

    public function updatePayment(Request $request)
    {
        try {
            $id = Auth::user()->id;

            $update = User::find($id)->update([
                'name' => $request['name'],
                'address' => $request['address'],
                'province_id' => $request['province'],
                'cellphone' => $request['tel'],
            ]);

            if ($update) {
                return response()->json([
                    'status' => 'success',
                    'data' => 'Cập nhật thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Cập nhật thất bại'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function getOrder()
    {
        return view('user.order');
    }

    public function getListOrder(Request $request)
    {
        $id = Auth::user()->id;

//        $orders = Order::where([
//            ['status', '=', '1'],
//            ['data', '=', 'user'],
//            ['user_id', '=', $id]
//        ])->with('products')->get();

        $orders = \DB::table("orders")
            ->join('products', 'products.id', '=', 'orders.product_id')
            ->where('user_id', '=', $id)
            ->where('data', '=', 'user')
            ->where('status', '=', '1')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $orders
        ]);
    }

    public function changePassword()
    {
        return View('user.change-password');
    }

    public function submitChangePassword(Request $request)
    {
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $user_id = Auth::user()->id;

        $check = User::where('id', '=', $user_id)->first();

        if ($check) {
            if (\Hash::check($old_password, $check->password)) {
                $new_hash_password = \Hash::make(trim(strtolower($new_password)));
                $update_password = User::where('id', '=', $user_id)->update(['password' => $new_hash_password]);

                if ($update_password) {
                    return response()->json([
                        'status' => 'success',
                        'data' => 'Đổi mật khẩu thành công'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Đổi mật khẩu không thành công'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Mật khẩu cũ không đúng'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Người dùng không tồn tại'
            ]);
        }
    }
}
