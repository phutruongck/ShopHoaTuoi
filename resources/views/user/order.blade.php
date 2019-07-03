@extends('layouts.master')
@section('title', 'Danh sách đơn hàng')
@section('content')
    @if(Auth::check())
        <section class="home-section home-full-height bg-dark bg-gradient" id="home" data-background="{{ asset('images/biel-morro-259739-unsplash.jpg') }}">
            <div class="titan-caption">
                <div class="caption-content">
                    <div class="font-alt mb-40 titan-title-size-4">Đơn hàng đã đặt</div>
                </div>
            </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt">Danh sách đơn hàng đã đặt</h1>
                    </div>
                </div>
                <hr class="divider-w pt-20">
                <div class="row">
                    <div class="col-sm-12">
                    <table class="table table-striped table-border checkout-table" id="list-order">
                        <tbody>
                        <tr>
                            <th class="hidden-xs">Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th class="hidden-xs">Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <hr class="divider-w">
            </div>
        </section>
    @endif
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        getOrder()
    })

    function getOrder()
    {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/auth/get-list-order',
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if(response.status === 'success') {
                    console.log(response.data)
                    let data = ''
                    $.map(response.data, function(value) {
                        data += '<tr>'
                        data += '<td class="hidden-xs"><a href="/product-detail/' + value.product_id + '"><img src="' + value.image_link + '" alt="' + value.name + '"/></a></td>'
                        data += '<td>'
                        data += '<h5 class="product-title font-alt">' + value.name + '</h5>'
                        data += '</td>'
                        data += '<td class="hidden-xs">'
                        data += '<h5 class="product-title font-alt">' + getNumberWithCommas(value.price) + ' VND</h5>'
                        data += '</td>'
                        data += '<td>'
                        data += '<h5 class="product-title font-alt">' + value.qty + '</h5>'
                        data += '</td>'
                        data += '<td>'
                        data += '<h5 class="product-title font-alt">' + getNumberWithCommas(value.amount) + ' VND</h5>'
                        data += '</td>'
                        data += '</tr>'
                    })

                    $('#list-order>tbody').append(data)
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText)
            }
        })

        return false
    }
</script>
@endsection
