@extends('clients/layouts/master')
@section('content')
 <!-- Hero Section Begin -->


<!-- Banner Section Begin -->

<!-- Banner Section End -->

<!-- Women Banner Section Begin -->
<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="{{asset('clients/img/products/women-large.jpg')}}">
                    <h2>Thời trang nữ</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="section-title">
                    <h2 style="margin-top: 30px">News</h2>
                </div>
                <div class="product-slider owl-carousel">
                    
                    @foreach ($female as $item)
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="http://laravel.training:86/upload/ul_Admin/{{$item['image']}}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                            <li class="w-icon active"><a href="{{route('add_from_home',$item['id'])}}"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{route('product_detail',$item['id'])}}">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$item['gender']}}</div
                            <a href="#">
                                <h5>{{$item['name']}}</h5>
                            </a>
                            <div class="product-price">
                                {{number_format($item['price'],2)}}
                                {{-- <span>$35.00</span> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Women Banner Section End -->

<!-- Man Banner Section Begin -->
<section class="man-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title">
                    <h2>News</h2>
                </div>
                <div class="product-slider owl-carousel">
                    
                    @foreach ($male as $item)
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="http://laravel.training:86/upload/ul_Admin/{{$item['image']}}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="{{route('add_from_home',$item['id'])}}"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{route('product_detail',$item['id'])}}">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$item['gender']}}</div
                            <a href="#">
                                <h5>{{$item['name']}}</h5>
                            </a>
                            <div class="product-price">
                                {{number_format($item['price'],2)}}
                                {{-- <span>$35.00</span> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-3 offset-lg-1">
                <div class="product-large set-bg m-large" data-setbg="{{asset('clients/img/products/man-large.jpg')}}">
                    <h2>Thời trang nam</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Man Banner Section End -->

<section class="women-banner spad">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="product-large set-bg" data-setbg="{{asset('clients/img/products/women-large.jpg')}}">
                    <h2>Women’s</h2>
                    <a href="#">Discover More</a>
                </div>
            </div>
            <div class="col-lg-8 offset-lg-1">
                <div class="section-title">
                    <h2 style="margin-top: 20px">New for women</h2>
                </div>
                <div class="product-slider owl-carousel">
                    
                    @foreach ($female as $item)
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="http://laravel.training:86/upload/ul_Admin/{{$item['image']}}" alt="">
                            <div class="icon">
                                <i class="icon_heart_alt"></i>
                            </div>
                            <ul>
                                <li class="w-icon active"><a href="{{route('add_from_home',$item['id'])}}"><i class="icon_bag_alt"></i></a></li>
                                <li class="quick-view"><a href="{{route('product_detail',$item['id'])}}">+ Quick View</a></li>
                                <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                            </ul>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$item['gender']}}</div
                            <a href="#">
                                <h5>{{$item['name']}}</h5>
                            </a>
                            <div class="product-price">
                                {{number_format($item['price'],2)}}
                                {{-- <span>$35.00</span> --}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section Begin -->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-1.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-2.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-3.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-4.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-5.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
    <div class="insta-item set-bg" data-setbg="{{asset('clients/img/insta-6.jpg')}}">
        <div class="inside-text">
            <i class="ti-instagram"></i>
            <h5><a href="#">colorlib_Collection</a></h5>
        </div>
    </div>
</div>
<!-- Instagram Section End -->

 <!-- Latest Blog Section Begin -->
 <section class="latest-blog spad">
    <div class="container">
        <div class="benefit-items">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{asset('clients/img/icon-1.png')}}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Free Shipping</h6>
                            <p>For all order over 99$</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{asset('clients/img/icon-2.png')}}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Delivery On Time</h6>
                            <p>If good have prolems</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-benefit">
                        <div class="sb-icon">
                            <img src="{{asset('clients/img/icon-1.png')}}" alt="">
                        </div>
                        <div class="sb-text">
                            <h6>Secure Payment</h6>
                            <p>100% secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->

<!-- Partner Logo Section Begin -->
<div class="partner-logo">
    <div class="container">
        <div class="logo-carousel owl-carousel">
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{asset('clients/img/logo-carousel/logo-1.png')}}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{asset('clients/img/logo-carousel/logo-2.png')}}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{asset('clients/img/logo-carousel/logo-3.png')}}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{asset('clients/img/logo-carousel/logo-4.png')}}" alt="">
                </div>
            </div>
            <div class="logo-item">
                <div class="tablecell-inner">
                    <img src="{{asset('clients/img/logo-carousel/logo-5.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Partner Logo Section End -->
@endsection
