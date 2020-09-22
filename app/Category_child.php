<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_child extends Model
{
    //
    protected $guarded=[];
    protected $table = 'category_child';
    public $timestamps = true;

    public static $cate_child_rules = [
        'name'=>'required',
        'des'=>'required',
    ];

    public static $cate_child_message= [
        'name.required'=>'Tên không được để trống',
        'des.required'=>'Mô tả không được để trống',
    ];

}
