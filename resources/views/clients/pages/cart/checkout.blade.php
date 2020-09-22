@extends('clients/layouts/master')
@section('content')
 <!-- Breadcrumb Section Begin -->
 <div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form action="{{route('post_checkout')}}" method="post" class="checkout-form">
            {{ csrf_field() }}
            
            <div class="row">
                <div class="col-lg-6">
                   
                    <div class="checkout-content">
                        <a href="#" class="content-btn">Click Here To Login</a>
                    </div>
                    @if (isset($errors) && count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                           <li>Thông tin không đầy đủ hoặc chưa hợp lệ</li>
                        </ul>
                    </div>
                    @endif
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="fir">Full Name<span>*</span></label>
                            <input type="text" name="name" id="fir">
                        </div>
                        {{-- <div class="col-lg-6">
                            <label for="last">Last Name<span>*</span></label>
                            <input type="text" id="last">
                        </div> --}}
                        {{-- <div class="col-lg-12">
                            <label for="cun-name">Company Name</label>
                            <input type="text" id="cun-name">
                        </div> --}}
                        <div class="col-lg-12">
                            <label for="cun">Country<span>*</span></label>
                            <input type="text" name="country" id="cun">
                        </div>
                        <div class="col-lg-12">
                            <label for="town">Town / City<span>*</span></label>
                            <input type="text" name="city" id="town">
                            <input type="hidden" name="total" value="{{$total}}">
                        </div>
                        <div class="col-lg-12">
                            <label for="street">Street Address<span>*</span></label>
                            <input type="text" id="street" name="street" class="street-first">
                            {{-- <input type="text"> --}}
                        </div>
                        {{-- <div class="col-lg-12">
                            <label for="zip">Postcode / ZIP (optional)</label>
                            <input type="text" id="zip">
                        </div> --}}
                        
                        <div class="col-lg-6">
                            <label for="email">Email Address<span>*</span></label>
                            <input type="text" name="email" id="email">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Phone<span>*</span></label>
                            <input name="phone" type="text" id="phone">
                        </div>
                        {{-- <div class="col-lg-12">
                            <div class="create-item">
                                <label for="acc-create">
                                    Create an account?
                                    <input type="checkbox" id="acc-create">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="checkout-content">
                        <input type="text" placeholder="Enter Your Coupon Code">
                    </div>
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                @foreach ($cart_items as $item)
                                    <li class="fw-normal"> {{$item->name}} x {{$item->quantity}} <span><?php echo number_format(($item->price)*($item->quantity),2); ?></span></li>
                                @endforeach
                                
                                <li class="total-price" >Total <span>{{number_format($total,2)}}</span></li>
                            </ul>
                            <div class="payment-check">
                                <div class="pc-item">
                                    <label for="pc-check">
                                        Cheque Payment
                                        <input type="checkbox" id="pc-check">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="pc-item">
                                    <label for="pc-paypal">
                                        Paypal
                                        <input type="checkbox" id="pc-paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection