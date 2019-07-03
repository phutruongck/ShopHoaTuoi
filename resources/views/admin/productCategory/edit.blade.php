@extends('admin.layouts.master')
@section('productCategories', 'active')

@section('title', 'Cập nhật loài hoa')

@section('stylesheets')
    <link href="{{ asset('assets/lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}"
          rel="stylesheet">
@endsection

@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <h4 class="page-title">Cập nhật loài hoa</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Chỉnh sửa</div>
                            </div>
                            <form method="POST" role="form" onsubmit="return false;">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Tên loài hoa</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Nhập vào tên loài hoa"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Mô tả</label>
                                        <input type="text" class="form-control" id="content" name="content"
                                               placeholder="Nhập vào mô tả"/>
                                    </div>
                                    <div class="form-group">
                                        <label for="image_link">Ảnh đại diện</label>
                                        {{-- <input type="text" class="form-control" id="image_link" name="image_link" placeholder="Nhập vào đường dẫn ảnh" /> --}}
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type="file" name="image_link"
                                                   onchange="readURL(this);" accept="image/*"/>
                                            <div class="drag-text">
                                                <h3>Kéo hình ảnh vào đây</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image"/>
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">Xoá
                                                    <span class="image-title"></span></button>
                                            </div>
                                        </div>
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
            getDataProductCategory(id)

            $('form').on('submit', function () {
                updateProductCategory(id)
            })
        })

        function getDataProductCategory(id) {
            $.ajax({
                type: "GET",
                dataType: "json",
                data: {'id': id},
                url: '/admin/get-once-product-category',
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    Swal.fire({
                        text: "Đang tải dữ liệu ...",
                        onOpen: () => {
                            swal.showLoading()
                        }
                    })
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('input[id="name"]').val(response.data['name'])
                        $('input[id="content"]').val(response.data['content'])
                        $('input[id="image_link"]').val(response.data['image_link'])
                        Swal.close()
                    } else {
                        Swal.fire({
                            position: "center",
                            type: "error",
                            title: response.data,
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                    Swal.close()
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText)
                }
            })
        }

        function updateProductCategory(id) {
            let inputName = $('input[id="name"]').val()
            let inputContent = $('input[id="content"]').val()
            let inputImageLink = $('input[type="file"]')[0].files[0]

            if (typeof inputName === 'undefined' || inputName == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('name', "Bạn chưa nhập tên")
                return false
            } else if (typeof inputContent === 'undefined' || inputContent == '') {
                $("form>.form-group").find(".alert-padding").remove();
                errMess('tel', "Bạn chưa nhập mô tả")
                return false
            } else {
                $("form>.form-group").find(".alert-padding").remove();

                var form_data = new FormData()
                form_data.append('id', id)
                form_data.append('name', inputName)
                form_data.append('content', inputContent)
                form_data.append('image_link', inputImageLink)

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/admin/update-product-category",
                    data: form_data,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    cache: false,
                    processData: false,
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
                                    window.location.href = "/admin/product-categories"
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader()

                reader.onload = function (e) {
                    $('.image-upload-wrap').hide()
                    $('.file-upload-image').attr('src', e.target.result)
                    $('.file-upload-content').show()
                    $('.image-title').html(input.files[0].name)
                }
                reader.readAsDataURL(input.files[0])
            } else {
                removeUpload()
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone())
            $('.file-upload-content').hide()
            $('.image-upload-wrap').show()
        }

        $('.image-upload-wrap').bind('dragover', function () {
            $('.image-upload-wrap').addClass('image-dropping')
        })

        $('.image-upload-wrap').bind('dragleave', function () {
            $('.image-upload-wrap').removeClass('image-dropping')
        })
    </script>
@endsection
