@extends('layouts.master')
@section('title', 'Tất cả sản phẩm hoa')
@section('content')
<section class="module bg-dark-60 shop-page-header" data-background="images/emre-gencer-264405-unsplash.jpg">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <h2 class="module-title font-alt">Tất cả sản phẩm</h2>
            </div>
        </div>
    </div>
</section>
<section class="module-small">
    <div class="container">
        <div class="row multi-columns-row">
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="pagination font-alt"><a href="#"><i class="fa fa-angle-left"></i></a><a class="active" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#"><i class="fa fa-angle-right"></i></a></div>
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
        url: "/show-all-product",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.status === 'success') {
                    let data = ''
                    $.each(response.data, function(i, item) {
                        data += '<div class="col-sm-6 col-md-3 col-lg-3">'
                        data += '<div class="shop-item">'
                        data += '<div class="shop-item-image"><img src="' + item.image_link + '" alt="' + item.name + '"/>'
                        data += '<div class="shop-item-detail"><a class="btn btn-round btn-b"><span class="icon-basket"> Thêm vào giỏ</span></a></div>'
                        data += '</div>'
                        data += '<h4 class="shop-item-title font-alt"><a href="/product-detail/' + item.id + '">' + item.name + '</a></h4>' + item.price
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
})
</script>
@endsection
