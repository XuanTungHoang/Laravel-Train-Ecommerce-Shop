<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $timestamps = true;

    public static $order_rules=[
        'name'=>'required',
        'country'=>'required',
        'city'=>'required',
        'street'=>'required',
        'email'=>'required|email',
        'phone'=>'required',
    ];

    public static $order_messages=[
        'name.required'=>'Tên sản phẩm không được để trống',
        'country.required'=>'Quốc gia của bạn không được để trống',
        'city.required'=>'Thành phố không được để trống',
        'street.required'=>'Địa chỉ phường/xã không được để trống',
        'email.required'=>'Email không được để trống',
        'email.email'=>'Email không hợp lệ',
        'phone.required'=>'Số điện thoại không được để trống',
       
    ];
}
