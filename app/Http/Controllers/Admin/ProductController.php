<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Product;
use App\ProductCategory;

class ProductController extends Controller
{
    public function index()
    {
        return View('admin.product.index');
    }

    public function getListProduct()
    {
        try {
            $list_product = Product::with('productCategories')->get();

            if ($list_product) {
                return response()->json([
                    'status' => 'success',
                    'data' => $list_product
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Không có sản phẩm nào...'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function deleteProduct(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            $delete = Product::where('id', '=', $id)->delete();

            if ($delete) {
                return response()->json([
                    'status' => 'success',
                    'data' => 'Xoá sản phẩm thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Sản phẩm không tồn tại'
                ]);
            }
        }
    }

    public function editProduct($id)
    {
        if ($id) {
            $check = Product::where('id', '=', $id);
            if ($check) {
                return View('admin.product.edit');
            }
        }
    }

    public function getOnceProduct(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            try {
                $data_once_product = Product::where('id', '=', $id)->first();

                if ($data_once_product) {
                    return response()->json([
                        'status' => 'success',
                        'data' => $data_once_product
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Không tồn tại sản phẩm'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Lấy thông tin sản phẩm thất bại...'
                ]);
            }
        }
    }

    public function updateProduct(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            $check_product = Product::where('id', '=', $id)->first();

            if ($check_product) {
                $name = $request['name'];
                $content = $request['content'];
                $price = $request['price'];
                $discount = $request['discount'];
                $product_category = $request['product_category'];
                $image_link = $request->file('image_link');

                $path_image = \Storage::disk('public')->putFile('images', $image_link);

                $update = Product::where('id', '=', $id)->update([
                    'name' => $name,
                    'content' => $content,
                    'price' => $price,
                    'discount' => $discount,
                    'catalog_id' => $product_category,
                    'image_link' => $path_image
                ]);

                if ($update) {
                    return response()->json([
                        'status' => 'success',
                        'data' => 'Cập nhật thành công'
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Cập nhật thất bại...'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Sản phẩm không tồn tại...'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Có lỗi, vui lòng thử lại sau...'
            ]);
        }
    }

    public function createOnceProduct()
    {
        return View('admin.product.create');
    }

    public function submitCreateOnceProduct(Request $request)
    {
        $name = $request['name'];
        $content = $request['content'];
        $price = $request['price'];
        $discount = $request['discount'];
        $product_category = $request['product_category'];

        $image_link = $request->file('image_link');

        try {
            $path_image = \Storage::disk('public')->putFile('images', $image_link);

            $create = Product::create([
                'name' => $name,
                'content' => $content,
                'price' => $price,
                'discount' => $discount,
                'catalog_id' => $product_category,
                'image_link' => $path_image,
                'image_list' => '',
                'view' => 0,
            ]);

            if ($create && $path_image) {
                return response()->json([
                    'status' => 'success',
                    'data' => 'Thêm sản phẩm thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Thêm sản phẩm thất bại...'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }
}
