@extends('layouts.master')

@section('content')
    @if(!Session::has('cart'))
        <section class="home-section home-full-height bg-dark bg-gradient" id="home" data-background="{{ asset('images/kasia-wanner-334445-unsplash.jpg') }}">
            <div class="titan-caption">
                <div class="caption-content">
                    <div class="font-alt mb-30 titan-title-size-1">Thanh toán thành công</div>
                    <div class="font-alt mb-40 titan-title-size-4">Cảm ơn bạn đã mua sắp tại Shop hoa tươi</div><a class="section-scroll btn btn-border-w btn-round" href="{{ route('all-product') }}">Tất cả sản phẩm</a>
                </div>
            </div>
        </section>
    @endif
@endsection
