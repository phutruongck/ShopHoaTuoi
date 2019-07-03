@extends('layouts.master')
@section('title', 'Chi tiết')
@section('content')
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 mb-sm-40">
                    <a class="gallery" href="">
                        <img src="" alt=""/>
                    </a>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="product-title font-alt"></h1>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <p class='product-view'></p>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                        <div class="price font-alt"><span class="amount"></span></div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="description">
                                <p></p>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-4 mb-sm-20">
                            <input class="form-control input-lg" type="number" name="" value="1" max="40" min="1" required="required"/>
                        </div>
                        <div class="col-sm-8"><a id="add_to_cart" class="btn btn-lg btn-block btn-round btn-b" href="">Thêm vào giỏ hàng</a></div>
                    </div>
                    <div class="row mb-20">
                        <div class="col-sm-12">
                            <div class="product_meta"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <hr class="divider-w">
    <section class="module-small">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt">Sản phẩm liên quan</h2>
                </div>
            </div>
            <div class="row multi-columns-row">
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    let id = "{{ Request::route('id') }}"
    let category = ""
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/show-product-detail",
            data: {
                'id': id
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    document.title = response.data.name + " | Shop bán hoa tươi"
                    $('.gallery').attr('href', response.data.image_link)
                    $('.gallery img').attr({'src': response.data.image_link, 'alt': response.data.name})
                    $('.product-title').text(response.data.name)
                    $('.product-view').text(response.data.view + " lượt xem")
                    $('.price>.amount').text(getNumberWithCommas(response.data.price) + " VND")
                    $('.description>p').text(response.data.content)
                    $('#add_to_cart').attr('href', '/add-to-cart/' + response.data.id)
                    $('.product_meta').html('Danh mục hoa: <a href="/product-category/' + response.data.product_categories.id + '">' + response.data.product_categories.name + '</a>')
                }
                else {
                    console.log(response.data)
                }

                showFourProduct(response.data.product_categories.id)
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
            }
        })
    })

    function showFourProduct(category) {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/show-four-product",
            data: {
                'id': category
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    let data = ''
                    $.each(response.data[0].products, function(i, item) {
                        data += '<div class="col-sm-6 col-md-3 col-lg-3">'
                        data += '<div class="shop-item">'
                        data += '<div class="shop-item-image"><img src="' + item.image_link + '" alt="' + item.name + '"/>'
                        data += '<div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-basket"> Thêm vào giỏ</span></a></div>'
                        data += '</div>'
                        data += '<h4 class="shop-item-title font-alt"><a href="/product-detail/' + item.id + '">' + item.name + '</a></h4>' + getNumberWithCommas(item.price) + ' VND'
                        data += '</div>'
                        data += '</div>'
                    })

                    $('.multi-columns-row').append(data)
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
