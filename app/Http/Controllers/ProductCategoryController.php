<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductCategory;
use App\Product;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return view('product.category');
    }

    public function getProductCategory()
    {
        $product_category = ProductCategory::all();

        return response()->json([
            'status' => 'success',
            'data' => $product_category
        ]);
    }

    public function showOnceProductCategory(Request $request)
    {
        $id = $request['id'];
        if($id) {
            try {
                // $once_product_category = \DB::table('product_categories')
                //                             ->join('products', 'products.catalog_id', '=', 'product_categories.id')
                //                             ->where('product_categories.id', '=', $id)
                //                             ->get();
                $once_product_category = ProductCategory::where('id', '=', $id)->with('products')->orderBy('id', 'desc')->get();
                return response()->json([
                    'status' => 'success',
                    'data' => $once_product_category
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
