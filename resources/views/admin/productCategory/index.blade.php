@extends('admin.layouts.master')
@section('productCategories', 'active')
@section('title', 'Danh sách loài hoa')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Danh sách loài hoa</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-sub">
                                    Danh sách loài hoa
                                </div>
                                <table class="table mt-3" id="list-user">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Mô tả</th>
                                        <th scope="col">Ảnh đại diện</th>
                                        <th scope="col">Cập nhật</th>
                                        <th scope="col">Xoá</th>
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
                <button onclick="window.location.href='{{ route('create-once-product-category') }}'" class="btn btn-info">Thêm loài hoa mới</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            getListProductCategory()
        })

        function getListProductCategory()
        {
            $.ajax({
                url: '/admin/get-list-product-category',
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
                            data += '<td>' + value.content + '</td>'
                            data += '<td><img src=' + "/storage/" + value.link_image + ' width="20%"></td>'
                            data += '<td><a href="/admin/edit-product-category/' + value.id + '"><i class="la la-edit"></i></a></td>'
                            data += '<td><button class="btn admin-delete-button" onclick="deleteProductCategory(' + value.id + ')"><i class="la la-times-circle"></i></button></td>'
                            data += '</tr>'
                            stt++
                        })
                        $('#list-user>tbody').append(data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }

        function deleteProductCategory(id)
        {
            $.ajax({
                url: '/admin/delete-product-category',
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
                                window.location.href = "/admin/product-categories"
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
