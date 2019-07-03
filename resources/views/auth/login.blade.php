@extends('layouts.master')
@section('title', 'Đăng nhập')
@section('content')
    <div class="main">
        <section class="module bg-dark-30" data-background="assets/images/emre-gencer-264405-unsplash.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h1 class="module-title font-alt mb-0">Đăng nhập</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-4 mb-sm-40">
                        <h4 class="font-alt">Đăng nhập</h4>
                        <hr class="divider-w mb-10">
                        <form class="form" onsubmit="return false;">
                            <div class="form-group">
                                <input class="form-control" id="email" type="text" name="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="password" type="password" name="password" placeholder="Mật khẩu" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-round btn-b">Đăng nhập</button>
                            </div>
                            <div class="form-group"><a href="">Quên mật khẩu?</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
<script>
    "use strict";

    $(document).ready(function () {
        $('form button').on('click', function (e) {
            e.preventDefault()
            let inputEmail = $('input[id="email"]').val()
            let inputPassword = $('input[id="password"]').val()

            if (typeof inputEmail === 'undefined' || inputEmail == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('email', "Bạn chưa nhập Email")
                return false
            }
            else if (IsEmail(inputEmail) == false) {
                $("form>.form-group").find(".alert-padding").remove();
                errMess("email", "Email không hợp lệ.");
                return false
            }
            else if (typeof inputPassword === 'undefined' || inputPassword == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('password', "Bạn chưa nhập mật khẩu")
                return false
            }
            else {
                $("form>.form-group").find(".alert-padding").remove();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/login",
                    data: { "email": inputEmail, "password": inputPassword },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        Swal.fire({
                            text: "Đang đăng nhập ...",
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
                                title: "Đăng nhập thành công",
                                showConfirmButton: false,
                                timer: 1000
                            })
                            .then(function () {
                                window.location.href = "/home"
                            })
                        }
                        else {
                            if(typeof response.data.email !== 'undefined' || response.data.email === null) {
                                Swal.close()
                                $("form>.form-group").find(".alert-padding").remove();
                                errMess("email", response.data.email[0]);
                                return false
                            }
                            else if(typeof response.data.password !== 'undefined' || response.data.password === null) {
                                Swal.close()
                                $("form>.form-group").find(".alert-padding").remove();
                                errMess("password", response.data.password[0]);
                                return false
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
        })
    })
</script>
@endsection
