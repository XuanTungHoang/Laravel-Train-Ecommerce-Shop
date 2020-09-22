<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    //
    protected $guarded=[];
    protected $table = 'products';
    public $timestamps = true;

    public static $pro_rules=[
        'name'=>'required',
        'des'=>'required',
        'price'=>'required',
        'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
        'cate_id'=>'required',
    ];

    public static $pro_messages=[
        'name.required'=>'Tên sản phẩm không được để trống',
        'des.required'=>'Mô tả sản phẩm không được để trống',
        'price.required'=>'Giá sản phẩm không được để trống',
        'image.mimes'=>'Hình ảnh sản phẩm không hợp lệ',
        'image.required'=>'Hình ảnh sản phẩm không được để trống',
        'image.max'=>'Kích thước hình ảnh quá lớn',
        'cate_id.required'=>'Bạn cần chọn thể loại cho sản phẩm'
    ];

    public static $role_add_image =[
        'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
    ];

    public static $mess_add_image =[
        'image.mimes'=>'Hình ảnh sản phẩm không hợp lệ',
        'image.required'=>'Hình ảnh sản phẩm không được để trống',
        'image.max'=>'Kích thước hình ảnh quá lớn',
    ];

    public static $pro_api_rules=[
        'name'=>'required',
        'des'=>'required',
        'price'=>'required|numeric',
        'gender'=>'required',
        'image'=>'mimes:jpeg,jpg,png,gif|required|max:10000',
        'cate_id'=>'required|array',
        'cate_id.*'=>[
            'required',
            'numeric',   // input must be of type number

        ],
    ];

    public static $pro_api_messages=[
        'name.required'=>'Tên sản phẩm không được để trống',
        'des.required'=>'Mô tả sản phẩm không được để trống',
        'price.required'=>'Giá sản phẩm không được để trống',
        'price.numeric'=>'Giá sản phẩm phải ở dạng số',
        'gender.required'=>'Giói tính không được để trống',
        'image.mimes'=>'Hình ảnh sản phẩm không hợp lệ',
        'image.required'=>'Hình ảnh sản phẩm không được để trống',
        'image.max'=>'Kích thước hình ảnh quá lớn',
        'cate_id.required'=>'Bạn cần chọn thể loại cho sản phẩm',
        'cate_id.array'=>'Hãy thử sửa key là cate_id[0]',
        'cate_id.*'=> 'ID của thể loại không đúng'
    ];
}
