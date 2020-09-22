@extends('clients/layouts/master')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text">
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <a href="{{route('categories',$breadcrumb[0]['id'])}}"><?php echo $breadcrumb[0]['name'] ?></a>
                    <span><?php if(!empty($breadcrumb_child)){ echo $breadcrumb_child[0]['name'] ;} ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Product Shop Section Begin -->
<section class="product-shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
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
            <div class="col-lg-9 order-1 order-lg-2">
                <div class="product-show-option">
                    <div class="row">
                        <div class="col-lg-7 col-md-7">
                            <div class="select-option">
                                <select class="sorting">
                                    <option value="">Default Sorting</option>
                                </select>
                                <select class="p-show">
                                    <option value="">Show:</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 text-right">
                            <p>Show 01- 09 Of 36 Product</p>
                        </div>
                    </div>
                </div>
                <div class="product-list">
                    <div class="row">
                        
                        {{-- product---item----here --}}
                        @foreach ($product_from_category as $item)                                          
                        <div class="col-lg-4 col-sm-6">
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
                                    <div class="catagory-name">{{$item['gender']}}</div>
                                    <a href="#">
                                        <h5>{{$item['name']}}</h5>
                                    </a>
                                    <div class="product-price">
                                        {{number_format($item['price'],2)}}
                                        {{-- <span>$35.00</span> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="loading-more">
                    <i class="icon_loading"></i>
                    <a href="#">
                        Loading More
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection