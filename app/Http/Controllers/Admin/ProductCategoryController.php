<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return View('admin.productCategory.index');
    }

    public function getListProductCategory()
    {
        try {
            $list_product_category = ProductCategory::get();

            if ($list_product_category) {
                return response()->json([
                    'status' => 'success',
                    'data' => $list_product_category
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Không có loài hoa nào...'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => $e
            ]);
        }
    }

    public function deleteProductCategory(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            $delete = ProductCategory::where('id', '=', $id)->delete();

            if ($delete) {
                return response()->json([
                    'status' => 'success',
                    'data' => 'Xoá loài hoa thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Loài hoa không tồn tại'
                ]);
            }
        }
    }

    public function editProductCategory($id)
    {
        if ($id) {
            $check = ProductCategory::where('id', '=', $id);
            if ($check) {
                return View('admin.productCategory.edit');
            }
        }
    }

    public function getOnceProductCategory(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            try {
                $data_once_product_category = ProductCategory::where('id', '=', $id)->first();

                if ($data_once_product_category) {
                    return response()->json([
                        'status' => 'success',
                        'data' => $data_once_product_category
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'data' => 'Không tồn tại loài hoa này'
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

    public function updateProductCategory(Request $request)
    {
        $id = $request['id'];

        if ($id) {
            $check_product = ProductCategory::where('id', '=', $id)->first();

            if ($check_product) {
                $name = $request['name'];
                $content = $request['content'];
                $image_link = $request->file('image_link');

                $path_image = \Storage::disk('public')->putFile('images', $image_link);

                $update = ProductCategory::where('id', '=', $id)->update([
                    'name' => $name,
                    'content' => $content,
                    'link_image' => $path_image
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
                    'data' => 'Loài hoa không tồn tại...'
                ]);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'data' => 'Có lỗi, vui lòng thử lại sau...'
            ]);
        }
    }

    public function createOnceProductCategory()
    {
        return View('admin.productCategory.create');
    }

    public function submitCreateOnceProductCategory(Request $request)
    {
        $name = $request['name'];
        $content = $request['content'];
        $image_link = $request->file('image_link');

        try {
            $path_image = \Storage::disk('public')->putFile('images', $image_link);

            $create = ProductCategory::create([
                'name' => $name,
                'content' => $content,
                'link_image' => $path_image
            ]);

            if ($create) {
                return response()->json([
                    'status' => 'success',
                    'data' => 'Thêm loài hoa thành công'
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'data' => 'Thêm thất bại...'
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
