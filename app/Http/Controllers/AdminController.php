<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Product;
use App\ProductCategory;
use App\Province;

class AdminController extends Controller
{
    public function index()
    {
        return View('admin.index');
    }

    public function users()
    {
        return View('admin.user.index');
    }

    public function getDataUser(Request $request)
    {
        try {
            $users = User::count();
            $orders = Order::count();
            $products = Product::count();
            $product_categories = ProductCategory::count();

            if($users) {
                return response()->json([
                    'status' => 'success',
                    'data' => [
                        'users' => $users,
                        'orders' => $orders,
                        'products' => $products,
                        'product_categories' => $product_categories
                    ]
                ]);
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Không có người dùng'
                ]);
            }
        }
        catch(\Exception $e)
        {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function getListUser(Request $request)
    {
        $data_list_user = \DB::table('users')
                                ->join('provinces', 'users.province_id', '=', 'provinces.id')
                                ->select('users.id', 'users.name', 'users.email', 'users.birthday', 'users.address', 'users.cellphone', 'provinces.name as province_name')
                                ->orderBy('users.id')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $data_list_user
        ]);
    }

    public function deleteUser(Request $request)
    {
        $id = $request['id'];
        if($id) {
            $uid = \Auth::user()->id;

            if($uid == $id) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Bạn không thể xoá chính mình...'
                ]);
            }
            else {
                try {
                    $deleted = User::find($id)->delete();

                    if($deleted) {
                        return response()->json([
                            'status' => 'success',
                            'data' => 'Xoá người dùng thành công.'
                        ]);
                    }
                    else {
                        return response()->json([
                            'status' => 'error',
                            'data' => 'Xoá người dùng không thành công.'
                        ]);
                    }
                }
                catch(\Exception $e) {
                    return response()->json([
                        'status' => 'error',
                        'data' => $e
                    ]);
                }
            }
        }
        else {
            return response()->json([
                'status' => 'error',
                'data' => 'Xoá người dùng thất bại...'
            ]);
        }
    }

    public function editUser($id)
    {
        if($id) {
            return View('admin.user.edit');
        }
    }

    public function getOnceUser(Request $request)
    {
        $id = $request['id'];

        if($id) {
            try {
                $data_once_user = User::where('id', '=', $id)->first();

                if($data_once_user) {
                    return response()->json([
                        'status' => 'success',
                        'data' => $data_once_user
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Không tồn tại người dùng'
                    ]);
                }
            }
            catch(\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Lấy thông tin người dùng thất bại...'
                ]);
            }
        }
    }

    public function updateUser(Request $request)
    {
        $id = $request['id'];

        if($id) {
            $check_user = User::where('id', '=', $id)->first();

            if($check_user) {
                $name = $request['name'];
                $tel = $request['tel'];
                $address = $request['address'];
                $province = $request['province'];
                $birthday = $request['birthday'];

                $update = User::where('id', '=', $id)->update([
                    'name' => $name,
                    'address' => $address,
                    'province_id' => $province,
                    'cellphone' => $tel,
                    'birthday' => $birthday
                ]);

                if($update) {
                    return response()->json([
                        'status' => 'success',
                        'data' => 'Cập nhật thành công'
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Cập nhật thất bại...'
                    ]);
                }
            }
            else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Người dùng không tồn tại...'
                ]);
            }
        }
        else {
            return response()->json([
                'status' => 'error',
                'data' => 'Có lỗi, vui lòng thử lại sau...'
            ]);
        }
    }
}
