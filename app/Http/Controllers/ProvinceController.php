<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province;

class ProvinceController extends Controller
{
    public function getProvince()
    {
        try {
            $provinces = Province::all();

            return response()->json([
                'status' => 'success',
                'data' => $provinces
            ]);
        }
        catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }
}
