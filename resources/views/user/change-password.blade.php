@extends('layouts.master')
@section('title', 'Đổi mật khẩu')
@section('content')
    @if(Auth::check())
        <section class="home-section home-full-height bg-dark bg-gradient" id="home"
                 data-background="{{ asset('images/kasia-wanner-334445-unsplash.jpg') }}">
            <div class="titan-caption">
                <div class="caption-content">
                    <div class="font-alt mb-40 titan-title-size-4">Đổi mật khẩu</div>
                </div>
            </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h4 class="font-alt mb-0">Thông tin thanh toán</h4>
                        <hr class="divider-w mt-10 mb-20">
                        <form method="POST" class="form" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <input class="form-control input-lg" type="password" name="old_password"
                                       id="old_password" placeholder="Nhập mật khẩu cũ"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="new_password" id="new_password"
                                       placeholder="Nhập mật khẩu mới"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="password" name="re_new_password" id="re_new_password"
                                       placeholder="Nhập lại mật khẩu mới"/>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-border-d btn-round btn-block" type="submit">Đổi mật khẩu</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="divider-w">
            </div>
        </section>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('form').on('submit', function () {
                submitChanged()
            })
        })

        function submitChanged() {
            let inputOldPassword = $('input[id="old_password"]').val()
            let inputNewPassword = $('input[id="new_password"]').val()
            let inputReNewPassword = $('input[id="re_new_password"]').val()

            if (typeof inputOldPassword === 'undefined' || inputOldPassword == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('old_password', "Bạn chưa nhập mật khẩu cũ")
                return false
            } else if (typeof inputNewPassword === 'undefined' || inputNewPassword == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('new_password', "Bạn chưa nhập mật khẩu mới")
                return false
            } else if (typeof inputReNewPassword === 'undefined' || inputReNewPassword == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('re_new_password', "Bạn chưa nhập lại mật khẩu mới")
                return false
            } else if (inputNewPassword.length < 8) {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('new_password', "Mật khẩu mới phải trên 8 ký tự")
                return false
            } else if (inputNewPassword !== inputReNewPassword) {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('new_password', "Mật khẩu mới không khớp")
                return false
            } else {
                $("form>.form-group").find(".alert-padding").remove();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/auth/submit-change-password",
                    data: {"old_password": inputOldPassword, "new_password": inputNewPassword},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        Swal.fire({
                            text: "Đang đổi mật khẩu ...",
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
                                    window.location.href = "/auth/info-payment"
                                })
                        } else {
                            console.log(response.data)
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

