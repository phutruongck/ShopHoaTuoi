<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Product::create([
            'catalog_id' => 1,
            'name' => 'HOA CẨM CHƯỚNG - LOVE TO BE LOVED',
            'content' => 'Bình hoa gồm có hoa hồng đỏ, hoa hồng tím kết hợp hoa cẩm chướng, hoa lan tượng trưng cho một tình yêu thanh khiết, trong trắng nhưng cũng rất mãnh liệt.',
            'price' => 2000000,
            'discount' => 0,
            'image_link' => '/images/2519_hoa-tuoi.jpg',
            'image_list' => '',
            'view' => 1,
        ]);

        App\Product::create([
            'catalog_id' => 1,
            'name' => 'HOA CẨM CHƯỚNG - TUỔI HỒNG',
            'content' => '"Tuổi hồng" mang đến cho người nhìn với biết bao cảm nhận về sự ngây thơ, dịu dàng và tươi mới của thời thanh xuân thiếu nữ. Hệt như những giấc mơ ngọt ngào và đầy lãng mạn, sáng trong.',
            'price' => 950000,
            'discount' => 0,
            'image_link' => '/images/4006_hoa-tuoi.jpg',
            'image_list' => '',
            'view' => 1,
        ]);

        App\Product::create([
            'catalog_id' => 2,
            'name' => 'HOA CÚC - SEASON\'S LOVE',
            'content' => 'Hộp hoa "Season\'s love" được thiết kế với hoa hồng đỏ chủ đạo và mang màu sắc tươi sáng, ngọt ngào. Đúng như tên gọi, mẫu hoa tựa như lời yêu thương gửi đến người thân, gia đình và bạn bè. Khởi đầu một mùa xuân mới với thông điệp yêu thương này bạn nhé!',
            'price' => 500000,
            'discount' => 0,
            'image_link' => '/images/4375_hoa-tuoi.jpg',
            'image_list' => '',
            'view' => 1,
        ]);

        App\Product::create([
            'catalog_id' => 3,
            'name' => 'HOA ĐỒNG TIỀN - TƯƠI SÁNG 3',
            'content' => 'Với tông màu hồng tươi sáng kết hợp với màu vàng, "Tươi Sáng III" hệt như chính cái tên của mình, không chỉ mang lại những lời chúc mừng tốt đẹp dành cho ngày khai trương, kỉ niệm mà còn thêm vào không gian sự tươi vui, hi vọng.',
            'price' => 700000,
            'discount' => 0,
            'image_link' => '/images/4048_hoa-tuoi.jpg',
            'image_list' => '',
            'view' => 1,
        ]);

        App\Product::create([
            'catalog_id' => 3,
            'name' => 'Hoa Đồng Tiền',
            'content' => 'Kệ hoa chúc mừng được Hoayeuthuong đầu tư một cách nghiêm túc vì chúng tôi luôn hiểu rằng đó là uy tín của khách hàng, của cả một doanh nghiệp. Hoayeuthuong luôn được quý khách hàng, đặc biệt là các doanh nghiệp tin yêu và đặt thiết kế hoa chúc mừng phục vụ các dịp khai trương, khánh thành, tổ chức sự kiện và trong các dịp lễ quan trọng khác',
            'price' => 1200000,
            'discount' => 0,
            'image_link' => '/images/7174_hoa-tuoi.jpg',
            'image_list' => '',
            'view' => 1,
        ]);
    }
}
