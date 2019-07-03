<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index');
    }

    public function allProduct()
    {
        return view('product.all');
    }

    public function showAllProduct()
    {
        try {
                $all_product = Product::orderBy('id', 'desc')->get();

                return response()->json([
                    'status' => 'success',
                    'data' => $all_product,
                ]);
            }
            catch(\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'data' => $e
                ]);
            }
    }

    public function showSixProduct()
    {
        try {
            $six_product = Product::orderBy('id', 'desc')->take(6)->get();

            return response()->json([
                'status' => 'success',
                'data' => $six_product,
            ]);
        }
        catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function showPopularProduct()
    {
        try {
            $popular_product = Product::orderBy('view', 'desc')->take(3)->get();

            return response()->json([
                'status' => 'success',
                'data' => $popular_product,
            ]);
        }
        catch(\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function showOnceProduct(Request $request)
    {
        $id = $request['id'];

        if($id) {
            try {
                // $product = \DB::table('products')
                //                 ->join('product_categories', 'product_categories.id', '=', 'products.catalog_id')
                //                 ->where('products.id', '=', $id)
                //                 ->get();
                $product = Product::where('id', '=', $id)->with('productCategories')->first();

                return response()->json([
                    'status' => 'success',
                    'data' => $product,
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

    public function showFourProduct(Request $request)
    {
        $id = $request['id'];
        if($id) {
            try {
                $four_product_category = ProductCategory::where('id', '=', $id)->with('products')->orderBy('id', 'desc')->take(4)->get();
                return response()->json([
                    'status' => 'success',
                    'data' => $four_product_category
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
}
