@extends('admin.layouts.master')
@section('users', 'active')

@section('title', 'Cập nhật người dùng')

@section('stylesheets')
<link href="{{ asset('assets/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Cập nhật người dùng</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Chỉnh sửa</div>
                        </div>
                        <form method="POST" role="form" onsubmit="return false;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname">Tên đầy đủ</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập vào tên đầy đủ" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập vào Email" disabled/>
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập vào địa chỉ" />
                                </div>
                                <div class="form-group">
                                    <label for="province">Tỉnh / Thành phố</label>
                                    <select class="form-control" id="province" name="province">

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="province">Ngày sinh</label>
                                    <div class='input-group date' id='datetimepicker1' data-date-format="yyyy-mm-dd hh:ii">
                                        <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Ngày sinh" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Số điện thoại</label>
                                    <input type="number" class="form-control" id="tel" name="tel" placeholder="Nhập vào số điện thoại" />
                                </div>
                            </div>
                            <div class="card-action">
                                <button class="btn btn-success">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="{{ asset('assets/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        let id = {{ Request::segment(3) }}
        $(document).ready(function () {
            $("#datetimepicker1").datetimepicker({
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            })

            getProvince()
            getUser(id)

            $('form').on('submit', function() {
                updateUser(id)
            })
        })

        function getUser(id)
        {
            $.ajax({
                type: "GET",
                dataType: "json",
                data: { 'id' : id },
                url: '/admin/get-once-user',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('input[id="name"]').val(response.data['name'])
                        $('input[id="email"]').val(response.data['email']).attr('readonly', true)
                        $('input[id="tel"]').val(response.data['cellphone'])
                        $('input[id="birthday"]').val(response.data['birthday'])
                        $('input[id="address"]').val(response.data['address'])
                        $('option[value="' + response.data['province_id'] + '"]').attr('selected', 'selected')
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

        function updateUser(id)
        {
            let inputName = $('input[id="name"]').val()
            let inputTel = $('input[id="tel"]').val()
            let inputAddress = $('input[id="address"]').val()
            let inputProvince = $('select[id="province"] option:selected').val()
            let inputBirthday = $('input[id="birthday"]').val()

            if (typeof inputName === 'undefined' || inputName == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('name', "Bạn chưa nhập tên")
                return false
            }
            else if (typeof inputTel === 'undefined' || inputTel == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('tel', "Bạn chưa nhập số điện thoại")
                return false
            }
            else if (typeof inputAddress === 'undefined' || inputAddress == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('address', "Bạn chưa nhập địa chỉ")
                return false
            }
            else if (typeof inputProvince === 'undefined' || inputProvince == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('province', "Bạn chưa chọn địa chỉ")
                return false
            }
            else if (typeof inputBirthday === 'undefined' || inputBirthday == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMessDateTime("Bạn chưa nhập ngày sinh")
                return false
            }
            else {
                $("form>.form-group").find(".alert-padding").remove();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/update-user",
                    data: { "id" : id, "name": inputName, "tel": inputTel, "address": inputAddress, "province": inputProvince, "birthday": inputBirthday },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        Swal.fire({
                            text: "Đang cập nhật ...",
                            onOpen: () => {
                                swal.showLoading()
                            }
                        })
                    },
                    success: function (response) {
                        if (response.status === 'success') {
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
            }
        }
    </script>
@endsection
