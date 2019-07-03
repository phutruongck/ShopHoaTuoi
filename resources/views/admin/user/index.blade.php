@extends('admin.layouts.master')
@section('users', 'active')
@section('title', 'Danh sách người dùng')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Danh sách người dùng</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-sub">
                                    Danh sách người dùng
                                </div>
                                <table class="table mt-3" id="list-user">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Birthday</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Province</th>
                                            <th scope="col">Cellphone</th>
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
                url: '/admin/get-list-user',
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
                            data += '<td>' + value.email + '</td>'
                            data += '<td>' + value.birthday + '</td>'
                            data += '<td>' + value.address + '</td>'
                            data += '<td>' + value.province_name + '</td>'
                            data += '<td>' + value.cellphone + '</td>'
                            data += '<td><a href="/admin/edit-user/' + value.id + '"><i class="la la-edit"></i></a></td>'
                            data += '<td><button class="btn admin-delete-button" onclick="deleteUser(' + value.id + ')"><i class="la la-times-circle"></i></button></td>'
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

        function deleteUser(id)
        {
            $.ajax({
                url: '/admin/delete-user',
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
                            window.location.href = "/admin/users"
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
