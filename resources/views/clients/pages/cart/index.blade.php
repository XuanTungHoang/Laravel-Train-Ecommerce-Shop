@extends('clients/layouts/master')
@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./home.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Shopping Cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="cart-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th class="p-name">Product Name</th>
                                <th >Size</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th><i class="ti-close"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                        <form id="form" name="form" action="{{route('update_cart_detail')}}" method="post">
                        {{ csrf_field() }}
                            @foreach ($cart_items as $item)
                            <input type="hidden" name="id[]" value="{{$item->id}}">
                            {{-- <input type="hidden" name="quantity[]" value="{{$item->quantity}}"> --}}
                            <tr>
                               
                                <td class="cart-pic first-row"><img src="/upload/ul_Admin/{{$item->image}}" width="170px" height="170px" alt=""></td>
                                <td class="cart-title first-row">
                                    <h5>{{$item->name}}</h5>
                                </td>
                                <td class="cart-title first-row">
                                    <select name="size[]" id="size" >
                                        <option value="S" <?php if($item->size==='S'){ echo 'selected';} ?>>S</option>
                                        <option value="M" <?php if($item->size==='M'){ echo 'selected';} ?>>M</option>
                                        <option value="L" <?php if($item->size==='L'){ echo 'selected';} ?>>L</option>
                                        <option value="XS" <?php if($item->size==='XS'){ echo 'selected';} ?>>XS</option>
                                    </select>
                                    {{-- <h5>{{$item->size}}</h5> --}}
                                </td>
                                <td class="p-price first-row">{{number_format($item->price,2)}}</td>
                                <td class="qua-col first-row">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input name="quantity[]" type="text" value="{{$item->quantity}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="total-price first-row"><?php echo number_format(($item->price)*($item->quantity),2); ?></td>
                                <td class="close-td first-row"><a href="{{route('delete_cart_item',$item->id)}}"><i class="ti-close"></i></a></td>
                            </tr>
                            @endforeach
                        </form>    
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="cart-buttons">
                            <a href="/" class="primary-btn up-cart">Continue shopping</a>
                            <a class="primary-btn up-cart" href="javascript:{}" onclick="document.getElementById('form').submit();">Update cart</a>
                            {{-- <a href="#" class="primary-btn up-cart">Update cart</a> --}}
                        </div>
                        {{-- <div class="discount-coupon">
                            <h6>Discount Codes</h6>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Enter your codes">
                                <button type="submit" class="site-btn coupon-btn">Apply</button>
                            </form>
                        </div> --}}
                    </div>
                    <div class="col-lg-4 offset-lg-4">
                        <div class="proceed-checkout">
                            <ul>
                                <li class="subtotal">Subtotal <span>{{number_format($total,2)}}</span></li>
                                <li class="cart-total">Total <span>{{number_format($total,2)}}</span></li>
                            </ul>
                            <a href="{{route('get_checkout')}}" class="proceed-btn">PROCEED TO CHECK OUT</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection