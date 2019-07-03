@extends('admin.layouts.master')
@section('orders', 'active')
@section('title', 'Danh sách đơn hàng')
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Danh sách đơn hàng</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-sub">
                                    Danh sách đơn hàng
                                </div>
                                <table class="table mt-3" id="list-order">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tên</th>
                                        <th scope="col">Sản phẩm</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Ngày mua</th>
                                        <th scope="col">Ảnh đại diện</th>
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
            getListOrder()
        })

        function getListOrder()
        {
            $.ajax({
                url: '/admin/get-list-order',
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
                            data += '<td>' + value.user_name + '</td>'
                            data += '<td>' + value.product_name + '</td>'
                            data += '<td>' + value.quantity + '</td>'
                            data += '<td>' + value.amount + '</td>'
                            data += '<td>' + value.created_at + '</td>'
                            data += '<td><img src=' + '/storage/' + value.image_link + ' width="60%"></td>'
                            data += '</tr>'
                            stt++
                        })
                        $('#list-order>tbody').append(data)
                    }
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }
    </script>
@endsection

