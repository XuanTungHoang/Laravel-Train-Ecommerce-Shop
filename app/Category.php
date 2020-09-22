<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    //
    protected $guarded=[];
    protected $table = 'categories';
    public $timestamps = true;

    public static $cate_rules = [
        'name'=>'required',
    ];

    public static $cate_message= [
        'name.required'=>'Tên không được để trống'
    ];

    // public function getAll(){
    //     return $this->all();
    // }
}
