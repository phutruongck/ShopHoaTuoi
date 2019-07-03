@extends('layouts.master')
@section('title', 'Giỏ hàng')
@section('content')
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt">Giỏ hàng</h1>
                </div>
            </div>
            <hr class="divider-w pt-20">
            <div class="row">
                <div class="col-sm-12">
                <table class="table table-striped table-border checkout-table" id="checkout">
                    <tbody>
                    <tr>
                        <th class="hidden-xs">Sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th class="hidden-xs">Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xoá</th>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <input class="form-control" type="text" id="coupon_code" name="coupon_code" placeholder="Mã giảm giá"/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <button class="btn btn-round btn-g" type="submit" name="coupon_apply">Áp dụng</button>
                    </div>
                </div>
            </div>
            <hr class="divider-w">
            <div class="row mt-70">
                <div class="col-sm-5 col-sm-offset-7">
                    <div class="shop-Cart-totalbox">
                        <h4 class="font-alt">Tạm tính</h4>
                        <table class="table table-striped table-border checkout-table" id="completedPrice">
                            <tbody>
                            </tbody>
                        </table>
                        <a class="btn btn-lg btn-block btn-round btn-d" type="submit" href="{{ route('payment') }}">Tiến hành thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/get-cart",
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    console.log(response.data)

                    // Show total Price
                    let data_price = ''
                    data_price += '<tr>'
                    data_price += '<th>Giá sản phẩm: </th>'
                    data_price += '<td>' + getNumberWithCommas(response.data.totalPrice) + ' VND</td>'
                    data_price += '</tr>'
                    data_price += '<tr>'
                    data_price += '<th>Tiền ship: </th>'
                    data_price += '<td>' +  + ' VND</td>'
                    data_price += '</tr>'
                    data_price += '<tr class="shop-Cart-totalprice">'
                    data_price += '<th>Tổng tiền :</th>'
                    data_price += '<td>' + getNumberWithCommas(response.data.totalPrice) + ' VND</td>'
                    data_price += '</tr>'
                    $('#completedPrice>tbody').append(data_price)

                    // Show item on Cart
                    let data = ''
                    $.map(response.data.products, function(value) {
                        data += '<tr>'
                        data += '<td class="hidden-xs"><a href="/product-detail/' + value.item.id + '"><img src="' + value.item.image_link + '" alt="' + value.item.name + '"/></a></td>'
                        data += '<td>'
                        data += '<h5 class="product-title font-alt">' + value.item.name + '</h5>'
                        data += '</td>'
                        data += '<td class="hidden-xs">'
                        data += '<h5 class="product-title font-alt">' + getNumberWithCommas(value.item.price) + ' VND</h5>'
                        data += '</td>'
                        data += '<td>'
                        data += '<div class="quantity-block">'
                        data += '<div class="input-group bootstrap-touchspin">'
                        data += '<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-down" type="button" onclick="' + "location.href='/sub-to-cart/" + value.item.id + "&qty=" + value.qty + "'" + '">-</button></span>'
                        data += '<span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>'
                        data += '<input readonly type="tel" class="form-control quantity-r2 quantity js-quantity-product" min="0" value="' + value.qty + '" style="display: block;">'
                        data += '<span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>'
                        data += '<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up" type="button" onclick="' + "location.href='/add-to-cart/" + value.item.id + "'" + '">+</button></span>'
                        data += '</div>'
                        data += '</div>'
                        data += '</td>'
                        data += '<td>'
                        data += '<h5 class="product-title font-alt">' + getNumberWithCommas(value.price) + ' VND</h5>'
                        data += '</td>'
                        data += '<td class="pr-remove"><a href="/sub-to-cart/' + value.item.id + '&qty=all" title="Xoá sản phẩm"><i class="fa fa-times"></i></a></td>'
                        data += '</tr>'
                    })
                    $('#checkout>tbody').append(data)
                }
                else {
                    console.log(response.data)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
            }
        })
    })

    $('button#update_cart').on('click', function() {
        update_cart()
    })

    function update_cart() {
        let inputId = $('input[id="quantity"]').val()
        $('input[id="quantity"]').each(function() {
            var input = $(this)
            console.log(input)
        })

        alert(inputId)
        let data = {
            'id': inputId,
        }
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "/update-cart",
            data: data,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function() {

            }
        })
    }
</script>
@endsection
