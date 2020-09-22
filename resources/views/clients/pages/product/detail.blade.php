@extends('clients/layouts/master')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    {{-- <a href="./shop.html">Product</a> --}}
                    <span>Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad page-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="filter-widget">
                    <h4 class="fw-title">Categories</h4>
                 
                    <ul class="filter-catagories">
                        @foreach ($list_cate_child as $item)
                        <li><a href="{{route('cate_child',$item['id'])}}">{{$item['name']}}</a></li>
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="filter-widget">
                    <h4 class="fw-title">Gender</h4>
                    <ul class="filter-catagories">
                        <li><a href="#">Nam</a></li>
                        <li><a href="#">Nữ</a></li>
                        <li><a href="#">Nam-Nữ</a></li>
                    </ul>
                </div> --}}
                <div class="filter-widget">
                    <h4 class="fw-title">Tags</h4>
                    <div class="fw-tags">
                        <a href="#">Towel</a>
                        <a href="#">Shoes</a>
                        <a href="#">Coat</a>
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-pic-zoom">
                            <img class="product-big-img" src="http://laravel.training:86/upload/ul_Admin/{{$pro_detail[0]['image']}}" alt="">
                            <div class="zoom-icon">
                                <i class="fa fa-search-plus"></i>
                            </div>
                        </div>
                        <div class="product-thumbs">
                            <div class="product-thumbs-track ps-slider owl-carousel">
                                <div class="pt active" data-imgbigurl="http://laravel.training:86/upload/ul_Admin/{{$pro_detail[0]['image']}}"><img
                                    src="http://laravel.training:86/upload/ul_Admin/{{$pro_detail[0]['image']}}" alt=""></div>
                                @foreach ($alt_image as $item)
                                <div class="pt" data-imgbigurl="http://laravel.training:86/upload/ul_Admin/{{$item['alt_image']}}"><img
                                    src="http://laravel.training:86/upload/ul_Admin/{{$item['alt_image']}}" alt=""></div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details">
                            <div class="pd-title">
                                <span>oranges</span>
                                <h3>{{$pro_detail[0]['name']}}</h3>
                                <a href="#" class="heart-icon"><i class="icon_heart_alt"></i></a>
                            </div>
                            <div class="pd-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span>(5)</span>
                            </div>
                            <div class="pd-desc">
                                <p>{{$pro_detail[0]['description']}}</p>
                                <h4>{{number_format($pro_detail[0]['price'],2)}} <span></span></h4>
                            </div>
                        <form id="form" name="form" action="{{route('add_from_detail',$pro_detail[0]['id'])}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{$pro_detail[0]['id']}}">
                            <input type="hidden" name="name" value="{{$pro_detail[0]['name']}}">
                            <input type="hidden" name="price" value="{{$pro_detail[0]['price']}}">
                            <input type="hidden" name="image" value="{{$pro_detail[0]['image']}}">
                            <div class="pd-size-choose">
                                <div class="sc-item">
                                    <input type="radio" name="size" value="S" id="sm-size">
                                    <label for="sm-size">s</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="size" value="M" id="md-size">
                                    <label for="md-size">m</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="size" value="L" id="lg-size">
                                    <label for="lg-size">l</label>
                                </div>
                                <div class="sc-item">
                                    <input type="radio" name="size" value="XS" id="xl-size">
                                    <label for="xl-size">xs</label>
                                </div>
                            </div>
                            <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="quantity" type="text" value="1">
                                    </div>
                                   
                                    <button class="primary-btn pd-cart" type="submit">Add to cart</button>
                            </div>
                        </form>

                            <ul class="pd-tags">
                                <li><span>CATEGORIES</span>: {{$pro_detail[0]['parent']}}, {{$pro_detail[0]['child']}}</li>
                                <li><span>GENDER</span>: {{$pro_detail[0]['gender']}}</li>
                            </ul>
                            <div class="pd-share">
                                <div class="p-code">Sku : 00012</div>
                                <div class="pd-social">
                                    <a href="#"><i class="ti-facebook"></i></a>
                                    <a href="#"><i class="ti-twitter-alt"></i></a>
                                    <a href="#"><i class="ti-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product-tab">
                    <div class="tab-item">
                        <ul class="nav" role="tablist">
                            <li>
                                <a class="active" data-toggle="tab" href="#tab-1" role="tab">DESCRIPTION</a>
                            </li>
                            {{-- <li>
                                <a data-toggle="tab" href="#tab-2" role="tab">SPECIFICATIONS</a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#tab-3" role="tab">Customer Reviews (02)</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="tab-item-content">
                        <div class="tab-content">
                            <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                <div class="product-content">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <h5>Introduction</h5>
                                            <p>{{$pro_detail[0]['description']}} </p>
                                            {{-- <h5>Features</h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                                aliquip ex ea commodo consequat. Duis aute irure dolor in </p> --}}
                                        </div>
                                        <div class="col-lg-5">
                                            <img src="img/product-single/tab-desc.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Shop Section End -->

<!-- Related Products Section End -->
<div class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($related_pro as $item)
            @if ($item['id']!=$pro_detail[0]['id']) 
            <div class="col-lg-3 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="http://laravel.training:86/upload/ul_Admin/{{$item['image']}}" alt="">
                        <div class="icon">
                            <i class="icon_heart_alt"></i>
                        </div>
                        <ul>
                            <li class="w-icon active"><a href="#"><i class="icon_bag_alt"></i></a></li>
                            <li class="quick-view"><a href="{{route('product_detail',$item['id'])}}">+ Quick View</a></li>
                            <li class="w-icon"><a href="#"><i class="fa fa-random"></i></a></li>
                        </ul>
                    </div>
                    <div class="pi-text">
                        <div class="catagory-name">{{$item['gender']}}</div>
                        <a href="#">
                            <h5>{{$item['name']}}</h5>
                        </a>
                        <div class="product-price">
                            {{number_format($item['price'],2)}}
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- Related Products Section End -->

@endsection