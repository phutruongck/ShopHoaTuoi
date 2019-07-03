@extends('layouts.master')
@section('title', 'Trang chủ')
@section('content')
    <section class="home-section home-fade home-full-height" id="home">
        <div class="hero-slider">
            <ul class="slides">
                <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/annie-spratt-277569-unsplash.jpg&quot;);">
                    <div class="titan-caption">
                        <div class="caption-content">
                            <div class="font-alt mb-30 titan-title-size-1">SHOP BÁN HOA TƯƠI</div>
                            <div class="font-alt mb-30 titan-title-size-4"> MÙA HÈ 2019</div>
                            <div class="font-alt mb-40 titan-title-size-1">NƠI TỔNG HỢP NHỮNG LOÀI HOA ĐẸP NHẤT</div><a class="section-scroll btn btn-border-w btn-round" href="{{ route('show-popular-product') }}">Xem thêm</a>
                        </div>
                    </div>
                </li>
                <li class="bg-dark-30 bg-dark shop-page-header" style="background-image:url(&quot;assets/images/shop/brigitte-tohm-210081-unsplash.jpg&quot;);">
                    <div class="titan-caption">
                        <div class="caption-content">
                            <div class="font-alt mb-30 titan-title-size-1"> MUA HOA ĐẸP</div>
                            <div class="font-alt mb-40 titan-title-size-4">TẤT CẢ SẢN PHẨM</div><a class="section-scroll btn btn-border-w btn-round" href="{{ route('all-product') }}">Xem thêm</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <div class="main">
        <section class="module-small">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2 class="module-title font-alt">HOA MỚI NHẤT</h2>
                    </div>
                </div>
                <div class="row multi-columns-row" id="new">
                </div>
                <div class="row mt-30">
                    <div class="col-sm-12 align-center"><a class="btn btn-b btn-round" href="{{ route('all-product') }}">Xem tất cả sản phẩm</a></div>
                </div>
            </div>
        </section>
        <hr class="divider-w">
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h2 class="module-title font-alt">Sản phẩm phổ biến</h2>
                    </div>
                </div>
                <div class="row multi-columns-row" id="popular">
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/show-all-product",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    let data = ''
                    $.each(response.data, function(i, item) {
                        data += '<div class="col-sm-6 col-md-4 col-lg-4">'
                        data += '<div class="shop-item">'
                        data += '<div class="shop-item-image">'
                        data += '<img src="/storage/' + item.image_link + '" alt="' + item.name + '"/>'
                        data += '<div class="shop-item-detail"><a class="btn btn-round btn-b" href="/add-to-cart/' + item.id + '"><span class="icon-basket"> Thêm vào giỏ</span></a></div>'
                        data += '</div>'
                        data += '<h4 class="shop-item-title font-alt"><a href="/product-detail/' + item.id + '">' + item.name + '</a></h4>' + item.price
                        data += '</div>'
                        data += '</div>'
                    })
                    $('#new').append(data)

                }
                else {
                    console.log(response.data)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
            }
        })
        showPopularProduct()
    })

    function showPopularProduct() {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/show-popular-product",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    let data = ''
                    $.each(response.data, function(i, item) {
                        data += '<div class="col-sm-6 col-md-4 col-lg-4">'
                        data += '<div class="shop-item">'
                        data += '<div class="shop-item-image">'
                        data += '<img src="/storage/' + item.image_link + '" alt="' + item.name + '"/>'
                        data += '<div class="shop-item-detail"><a class="btn btn-round btn-b" href="/add-to-cart/' + item.id + '"><span class="icon-basket"> Thêm vào giỏ</span></a></div>'
                        data += '</div>'
                        data += '<h4 class="shop-item-title font-alt"><a href="/product-detail/' + item.id + '">' + item.name + '</a></h4>' + item.price
                        data += '</div>'
                        data += '</div>'
                    })
                    $('#popular').append(data)
                }
                else {
                    console.log(response.data)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
            }
        })
    }
</script>
@endsection
