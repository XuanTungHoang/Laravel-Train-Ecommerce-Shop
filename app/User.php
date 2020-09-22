<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $user_rules=[
        'name'=>'required',
        'email'=>'required|email',
        'password'=>'required|min:6',
        'password_confirm'=>'same:password',
    ]; 
    public static $user_messages=[
        'name.required'=>'Tên không được để trống',
        'email.required'=>'Email không được để trống',
        'email.email'=>'Email không hợp lệ',
        'password.required'=>'Mật khẩu không được để trống',
        'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự',
        'password_confirm.same'=>'Mật khẩu xác nhận không đúng',
    ];

}
