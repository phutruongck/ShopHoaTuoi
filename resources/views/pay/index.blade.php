@extends('layouts.master')

@section('stylesheets')
<link href="{{ asset('assets/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if(Session::has('cart'))
        <section class="module bg-dark-30 about-page-header" data-background="images/anton-darius-thesollers-379581-unsplash.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <h1 class="module-title font-alt mb-0">Thanh toán</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <h4 class="font-alt mb-0">Thông tin cá nhân</h4>
                        <hr class="divider-w mt-10 mb-20">
                        <form method="POST" class="form" role="form" onsubmit="return false;">
                            <div class="form-group">
                                <input class="form-control input-lg" type="text" name="name" id="name" placeholder="Họ và tên"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="email" id="email" placeholder="Email"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="number" name="tel" id="tel" placeholder="Số điện thoại"/>
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" name="address" id="address" placeholder="Địa chỉ"/>
                            </div>
                            <div class="form-group">
                                <div class='input-group date' id='datetimepicker1' data-date-format="yyyy-mm-dd hh:ii">
                                    <input type="text" class="form-control" name="birthday" id="birthday" placeholder="Ngày sinh" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="province" name="province">
                                </select>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-border-d btn-round btn-block" type="submit">Đặt hàng</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr class="divider-w">
                <div class="row mt-70">
                    <div class="col-sm-5 col-sm-offset-7">
                        <div class="shop-Cart-totalbox">
                            <h4 class="font-alt">Thành tiền</h4>
                            <table class="table table-striped table-border checkout-table" id="completedPrice">
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
    <script>
        window.location.href = '/home'
    </script>
    @endif
@endsection

@section('scripts')
    <script src="{{ asset('assets/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            let isUser = 0
            $("#datetimepicker1").datetimepicker({
                autoclose: true,
                todayBtn: true,
                pickerPosition: "bottom-left"
            })

            getProvince()
            getCart()

            @if(Auth::check())
            getUser()
            isUser = 1
            @endif

            $('form').on('submit', function() {
                payment(isUser)
            })
        })

        function getCart() {
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/get-cart",
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.status === 'success') {
                        // Show total Price
                        let data_price = ''
                        data_price += '<tr>'
                        data_price += '<th>Giá sản phẩm: </th>'
                        data_price += '<td>' + getNumberWithCommas(response.data.totalPrice) + ' VND</td>'
                        data_price += '</tr>'
                        data_price += '<tr>'
                        data_price += '<th>Tiền ship: </th>'
                        data_price += '<td>' +  + ' VND</td>'
                        data_price += '</tr>'
                        data_price += '<tr class="shop-Cart-totalprice">'
                        data_price += '<th>Tổng tiền :</th>'
                        data_price += '<td>' + getNumberWithCommas(response.data.totalPrice) + ' VND</td>'
                        data_price += '</tr>'
                        $('#completedPrice>tbody').append(data_price)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }

        function payment(isUser) {
            let inputName = $('input[id="name"]').val()
            let inputEmail = $('input[id="email"]').val()
            let inputTel = $('input[id="tel"]').val()
            let inputAddress = $('input[id="address"]').val()
            let inputBirthday = $('input[id="birthday"]').val()
            let inputProvince = $('select[id="province"]').val()

            if (typeof inputName === 'undefined' || inputName == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('name', "Bạn chưa nhập tên")
                return false
            }
            else if (typeof inputEmail === 'undefined' || inputEmail == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('email', "Bạn chưa nhập Email")
                return false
            }
            else if (IsEmail(inputEmail) == false) {
                $("form>.form-group").find(".alert-padding").remove();
                errMess("email", "Email không hợp lệ.");
                return false
            }
            else if (typeof inputAddress === 'undefined' || inputAddress == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('address', "Bạn chưa nhập địa chỉ")
                return false
            }
            else if (typeof inputTel === 'undefined' || inputTel == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('tel', "Bạn chưa nhập số điện thoại")
                return false
            }
            else if (typeof inputBirthday === 'undefined' || inputBirthday == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('birthday', "Bạn chưa nhập ngày sinh")
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
                    url: "/submit-payment",
                    data: { "isUser": isUser, "name": inputName, "email": inputEmail, "tel": inputTel, "address": inputAddress, "birthday": inputBirthday, "province": inputProvince },
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function () {
                        Swal.fire({
                            text: "Đang thanh toán ...",
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
                                window.location.href = "/completed-payment"
                            })
                        }
                        else {
                            if(typeof response.data.email !== 'undefined' || response.data.email === null) {
                                Swal.close()
                                $("form>.form-group").find(".alert-padding").remove();
                                errMess("email", response.data.email[0]);
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
        }

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
                        console.log(response.data)
                        $('input[id="name"]').val(response.data['name'])
                        $('input[id="email"]').val(response.data['email']).attr('readonly', true)
                        $('input[id="tel"]').val(response.data['cellphone'])
                        $('input[id="birthday"]').val(response.data['birthday'])
                        $('input[id="address"]').val(response.data['address'])
                        $('option[value="' + response.data['province_id'] + '"]').attr('selected', 'selected')
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }
    </script>
@endsection
