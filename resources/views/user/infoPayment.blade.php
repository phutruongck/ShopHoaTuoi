@extends('layouts.master')
@section('title', 'Thông tin thanh toán')
@section('content')
    @if(Auth::check())
        <section class="home-section home-full-height bg-dark bg-gradient" id="home" data-background="{{ asset('images/kasia-wanner-334445-unsplash.jpg') }}">
            <div class="titan-caption">
                <div class="caption-content">
                    <div class="font-alt mb-40 titan-title-size-4">Thông tin thanh toán</div>
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
                                <input class="form-control input-lg" type="text" name="name" id="name" placeholder="Họ và tên" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" id="email" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="tel" id="tel" placeholder="Số điện thoại" />
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="address" id="address" placeholder="Địa chỉ" />
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="province" name="province">
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-border-d btn-round btn-block" type="submit">Lưu thông tin</button>
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
        $(document).ready(function() {
            getProvince()
            getUser()

            $('form').on('submit', function() {
                updateUser()
            })
        })

        function getUser()
        {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/auth/get-info-payment',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if(response.status === 'success') {
                        $('input[id="name"]').val(response.data['name'])
                        $('input[id="email"]').val(response.data['email']).attr('readonly', true)
                        $('input[id="tel"]').val(response.data['cellphone'])
                        $('input[id="address"]').val(response.data['address'])
                        $('option[value="' + response.data['province_id'] + '"]').attr('selected', 'selected')
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }

        function updateUser()
        {
            let inputName = $('input[id="name"]').val()
            let inputTel = $('input[id="tel"]').val()
            let inputAddress = $('input[id="address"]').val()
            let inputProvince = $('select[id="province"] option:selected').val()

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
            else {
                $("form>.form-group").find(".alert-padding").remove();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/auth/update-payment",
                    data: { "name": inputName, "tel": inputTel, "address": inputAddress, "province": inputProvince },
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
                                window.location.href = "/auth/info-payment"
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
