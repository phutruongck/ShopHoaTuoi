<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AccountController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function submitLogin(Request $request)
    {
        $rules = [
            'email' => 'required|exists:users|email|max:255',
            'password' => 'required|min:8',
        ];

        $messages = [
            'email.required' => 'Email không được để trống',
            'email.exists' => 'Email không tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được dài hơn 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không đuợc nhỏ hơn 8 ký tự',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors()
            ]);
        }
        else {
            $credentials = $request->only('email', 'password');

            try {
                $auth = \Auth::guard('web')->attempt($credentials);
                if ($auth) {
                    return response()->json([
                        'status' => 'success',
                        'data' => 'Đăng nhập thành công'
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Tên đăng nhập hoặc mật khẩu không đúng'
                    ]);
                }
            }
            catch (Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Có lỗi, vui lòng thử lại'
                ]);
            }
        }
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function submitRegister(Request $request)
    {
        $rules = [
            'name' => 'required|max:255|regex:/^\S*$/u',
            'email' => 'required|unique:users|email|max:255',
            'password' => 'required|min:8',
        ];

        $messages = [
            'name.required' => 'Tên đăng nhập không được để trống',
            'name.max' => 'Tên đăng nhập không được dài hơn 255 ký tự',
            'name.regex' => 'Tên đăng nhập không được có khoảng trắng',
            'email.required' => 'Email không được để trống',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được dài hơn 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu không đuợc nhỏ hơn 8 ký tự',
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'data' => $validator->errors()
            ]);
        }
        else {
            try {
                $user = User::create([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => \Hash::make(trim(strtolower($request['password']))),
                    'address' => '',
                    'province_id' => 1,
                    'cellphone' => '',
                    'rule' => 3,
                    'status' => 1,
                    'remember_token' => ''
                ]);

                if($user) {
                    return response()->json([
                        'status' => 'success',
                        'data' => 'Đăng ký thành công'
                    ]);
                }
                else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Đăng ký không thành công, vui lòng thử lại'
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

    public function submitLogout()
    {
        try {
            \Auth::logout();
            \Session::flush();

            return redirect()->route('client.home');
        }
        catch(\Exception $e) {
            return redirect()->route('client.home');
        }
    }
}
