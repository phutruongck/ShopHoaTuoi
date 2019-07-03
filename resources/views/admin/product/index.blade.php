@extends('admin.layouts.master')
@section('products', 'active')
@section('title', 'Danh sách sản phẩm')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Danh sách sản phẩm</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-sub">
                                    Danh sách sản phẩm
                                </div>
                                <table class="table mt-3" id="list-product">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Loài hoa</th>
                                            <th scope="col">Nội dung</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Ảnh đại diện</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card">
                        </div>
                    </div>
                </div>
                <button onclick="window.location.href='{{ route('create-once-product') }}'" class="btn btn-info">Thêm sản phẩm mới</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            getListUser()
        })

        function getListUser()
        {
            $.ajax({
                url: '/admin/get-list-product',
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status === 'success') {
                        let data = ''
                        let stt = 1
                        $.map(response.data, function(value) {
                            data += '<tr>'
                            data += '<td>' + stt + '</td>'
                            data += '<td>' + value.name + '</td>'
                            data += '<td>' + value.product_categories.name + '</td>'
                            data += '<td>' + value.content + '</td>'
                            data += '<td>' + value.price + '</td>'
                            data += '<td>' + value.discount + '</td>'
                            data += '<td><img src=' + "/storage/" + value.image_link + ' width="70%"></td>'
                            data += '<td><a href="/admin/edit-product/' + value.id + '"><i class="la la-edit"></i></a></td>'
                            data += '<td><button class="btn admin-delete-button" onclick="deleteProduct(' + value.id + ')"><i class="la la-times-circle"></i></button></td>'
                            data += '</tr>'
                            stt++
                        })
                        $('#list-product>tbody').append(data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }

        function deleteProduct(id)
        {
            $.ajax({
                url: '/admin/delete-product',
                type: "POST",
                data: { 'id' : id },
                dataType: "json",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    Swal.fire({
                        text: "Đang xoá ...",
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function(response) {
                    if(response.status === 'success') {
                        Swal.fire({
                            position: "center",
                            type: "success",
                            title: response.data,
                            showConfirmButton: false,
                            timer: 1000
                        })
                        .then(function () {
                            window.location.href = "/admin/products"
                        })
                    }
                    else {
                        Swal.fire({
                            position: "center",
                            type: "error",
                            title: response.data,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }
    </script>
@endsection
