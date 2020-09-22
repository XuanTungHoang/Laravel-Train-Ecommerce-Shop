<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
   
    public function get_login()
    {
        
        $user = User::where('email' , 'api@gmail.com')->where( 'password' , '123456')->where('status' , '1')->first();
       
        if($user){
            $access_token =  $user->createToken('my_token')->accessToken;
          //  session_start();
         
            Session::forget('token');
            Session::flush();
            
            Session::put('token',$access_token);
          //  $_SESSION['access_token']=$access_token;
            return $access_token;
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }


    
}
