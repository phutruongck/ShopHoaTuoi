@extends('layouts.master')
@section('title', 'Danh sách các loài hoa')
@section('content')
    <section class="module bg-dark-60 shop-page-header" data-background="">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h2 class="module-title font-alt"></h2>
                    <div class="module-subtitle font-serif"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="module-small">
        <div class="container">
            <form class="row">
                <div class="col-sm-4 mb-sm-20">
                    <select class="form-control">
                        <option selected="selected">Default Sorting</option>
                        <option>Popular</option>
                        <option>Latest</option>
                        <option>Average Price</option>
                        <option>High Price</option>
                        <option>Low Price</option>
                    </select>
                </div>
                <div class="col-sm-2 mb-sm-20">
                    <select class="form-control">
                        <option selected="selected">Woman</option>
                        <option>Man</option>
                    </select>
                </div>
                <div class="col-sm-3 mb-sm-20">
                    <select class="form-control">
                        <option selected="selected">All</option>
                        <option>Coats</option>
                        <option>Jackets</option>
                        <option>Dresses</option>
                        <option>Jumpsuits</option>
                        <option>Tops</option>
                        <option>Trousers</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    <button class="btn btn-block btn-round btn-g" type="submit">Apply</button>
                </div>
            </form>
        </div>
    </section>
    <hr class="divider-w">
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
    let id = "{{ Request::route('id') }}"
    $(document).ready(function () {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "/show-product-category",
            data: {
                'id': id
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('section.module').css('background-image', 'url(/storage/' + response.data[0].link_image + ')')
                    $('.module-title').text(response.data[0].name)
                    $('.module-subtitle').text(response.data[0].content)

                    let data = ''
                    $.each(response.data[0].products, function(i, item) {
                        data += '<div class="col-sm-6 col-md-4 col-lg-4">'
                        data += '<div class="shop-item">'
                        data += '<div class="shop-item-image">'
                        data += '<img src="' + item.image_link + '" alt="' + item.name + '"/>'
                        data += '<div class="shop-item-detail"><a class="btn btn-round btn-b" href="/add-to-cart/' + item.id + '"><span class="icon-basket"> Thêm vào giỏ</span></a></div>'
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
    })
</script>
@endsection
