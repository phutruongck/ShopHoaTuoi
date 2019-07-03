@extends('admin.layouts.master')
@section('dashboard', 'active')
@section('title', 'Bảng quản trị')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Bảng quản trị</h4>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-stats card-warning">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-users"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Người dùng</p>
                                            <h4 class="card-title" id="user-count"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-success">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-bar-chart"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Đơn hàng</p>
                                            <h4 class="card-title" id="order-count"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-danger">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-newspaper-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Sản phẩm</p>
                                            <h4 class="card-title" id="product-count"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-stats card-primary">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-5">
                                        <div class="icon-big text-center">
                                            <i class="la la-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col-7 d-flex align-items-center">
                                        <div class="numbers">
                                            <p class="card-category">Loại hoa</p>
                                            <h4 class="card-title" id="product-category-count"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/admin/get-data-user",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#user-count').text(response.data.users)
                        $('#order-count').text(response.data.orders)
                        $('#product-count').text(response.data.products)
                        $('#product-category-count').text(response.data.product_categories)
                    }
                    else {
                        console.log(response.data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                    Swal.fire({
                        position: "center",
                        type: "error",
                        title: "Có lỗi, vui lòng thử lại...",
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            })
            return false
        })
    </script>
@endsection
