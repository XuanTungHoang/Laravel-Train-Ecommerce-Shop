<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Opis\Closure\SecurityProvider;

class PageController extends Controller
{

    
    // Home page
    public function home_View(){
        $token=Session::get('token');
        // print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/home-view',[
                        'headers' => [
                       'Accept' => 'application/json',
                       'Authorization' => 'Bearer '.$token,
                   ],
            ])->getBody();

            $result=json_decode($response,true);
            return  $result;
    }

    // Product with category
    public function product_cate($cate_parent_id, Request $request){

        $token=Session::get('token');
        // print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/product-from-category/'.$cate_parent_id,[
                        'headers' => [
                       'Accept' => 'application/json',
                       'Authorization' => 'Bearer '.$token,
                   ],
            ])->getBody();

            $result=json_decode($response,true);
            return  $result;
        
    // }
    }
    public function product_cate_child($cate_child_id){

        $token=Session::get('token');
        // print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/product-from-cate-child/'.$cate_child_id,[
                        'headers' => [
                       'Accept' => 'application/json',
                       'Authorization' => 'Bearer '.$token,
                   ],
            ])->getBody();

            $result=json_decode($response,true);
            return  $result;
        
    }


    public function product_detail($pro_id){

        $token=Session::get('token');
        // print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/product-detail/'.$pro_id,[
                        'headers' => [
                       'Accept' => 'application/json',
                       'Authorization' => 'Bearer '.$token,
                   ],
            ])->getBody();

            $result=json_decode($response,true);
            return  $result;
    }




    public function api_home_view(){
      
        $token=Session::get('token');
        // print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/home-view',[
                        'headers' => [
                       'Accept' => 'application/json',
                       'Authorization' => 'Bearer '.$token,
                   ],
            ])->getBody();

            $result=json_decode($response,true);

            $this->dataSendView['male']=$result['male']['data'];
            $this->dataSendView['female']=$result['female']['data'];

            return $this->admin_View('clients/pages/home/index');
        
       
    }

    public function api_product_cate($cate_parent_id){

        $token=Session::get('token');
        //   print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/product-from-category/'.$cate_parent_id,[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            $this->dataSendView['list_cate_child']=$result['list_cate_child'];
            $this->dataSendView['product_from_category']=$result['product_from_category'];
            $this->dataSendView['breadcrumb']=$result['breadcrumb'];
        
            return $this->admin_View('clients/pages/category/index');
       
      
    }

    public function api_product_cate_child($cate_child_id){
       
        $token=Session::get('token');
    
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
           
        }
            $client= new Client();
             $response = $client->request('GET','localhost/learn_laravel/public/api/product-from-cate-child/'.$cate_child_id,[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
 
             $result=json_decode($response,true);
             $this->dataSendView['product_from_category']=$result['product_from_category'];
             $this->dataSendView['list_cate_child']=$result['list_cate_child'];
             $this->dataSendView['breadcrumb']=$result['breadcrumb'];
             $this->dataSendView['breadcrumb_child']=$result['breadcrumb_child'];
     
             return $this->admin_View('clients/pages/category/index');
       
    }

    public function api_product_detail($pro_id){

        $token=Session::get('token');
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
           
        }
            $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/product-detail/'.$pro_id,[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
 
            $result=json_decode($response,true);

            $this->dataSendView['list_cate_child']=$result['list_cate_child'];
            $this->dataSendView['alt_image']=$result['alt_image'];
            $this->dataSendView['pro_detail']=$result['pro_detail'];
            $this->dataSendView['related_pro']=$result['related_pro']['data'];

            return $this->admin_View('clients/pages/product/detail');
    }

   
   
    
}
