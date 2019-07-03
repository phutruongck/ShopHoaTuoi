<?php

use Illuminate\Database\Seeder;
use App\ProductCategory;

class ProductCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::create([
            'name' => 'Cẩm Chướng',
            'content' => 'Hoa Cẩm Chướng',
            'link_image' => '/images/cam-chuong-do_0.jpg'
        ]);

        ProductCategory::create([
            'name' => 'Cúc',
            'content' => 'Hoa Cúc',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Đồng Tiền',
            'content' => 'Đồng Tiền',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Hồng',
            'content' => 'Hoa Hồng',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Hồ Điệp',
            'content' => 'Hoa Hồ Điệp',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Loa Kèn',
            'content' => 'Hoa Loa Kèn',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Ly',
            'content' => 'Hoa Ly',
            'link_image' => ''
        ]);

        ProductCategory::create([
            'name' => 'Sen',
            'content' => 'Hoa Sen',
            'link_image' => ''
        ]);
    }
}
