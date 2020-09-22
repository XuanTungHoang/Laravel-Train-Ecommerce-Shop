<?php

namespace App\Http\Controllers;

use App\Order;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    public function get_checkout(){
        $token=Session::get('token');

        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
           
        }
        $client= new Client();
        $response = $client->request('GET','localhost/learn_laravel/public/api/get-checkout',[
                    'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
        ])->getBody();
    
        $result=json_decode($response,true);
        if(!empty($result)){
            return $this->admin_View('/clients/pages/cart/checkout');
        }
        
    }

    public function thankyou(){

        $token=Session::get('token');

        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/thankyou',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            if(!empty($result)){
                return $this->admin_View('/clients/pages/cart/thankyou');
            }
    }

    public function post_checkout(){

        $token=Session::get('token');

        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/post-checkout',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            //  foreach($result['cart_items'] as $item){
            //      echo $item['id'];
            //  }
            // die('5');
            if(!empty($result)){

                $cart_items=$result['cart_items'];

                $validate=Validator::make($this->request,Order::$order_rules,Order::$order_messages);
                if($validate->fails()){
                    return redirect(action('OrderController@get_checkout'))->withInput()->withErrors($validate->errors()->all());
                }else{
                    $order = new Order();
                    $order->name=$this->request['name'];
                    $order->country=$this->request['country'];
                    $order->city=$this->request['city'];
                    $order->street_address=$this->request['street'];
                    $order->email=$this->request['email'];
                    $order->phone=$this->request['phone'];
                    $order->total=$this->request['total'];
                    $order->status='waitting';
                   
                    $order->save();
                    if(!empty($order)){
        
                      //  $cart_items=DB::table('cart')->get();
                        if(!empty($cart_items)){
                            // print_r($order->id);
                            // die('5');
                            $flag=0;
                            $date=Carbon::now();
                            foreach ($cart_items as $item){
                                
                                $add_to_order_detail=DB::table('orders_detail')
                                ->insert(['order_id'=>$order->id,'pro_id'=>$item['pro_id'],'quantity'=>$item['quantity'],'created_at'=>$date,'updated_at'=>$date]);
                                $flag=1;
                            }
                            if($flag==1){
                                $delete_cart=DB::table('cart')->whereNotNull('id')->delete();
                                if($delete_cart){
                                    return redirect(action('OrderController@thankyou'))->with(['notification'=>'thành công']);
                                }
                            }
                        }
                    }
                }
            }
    }  

    public function json_thankyou(){

        $token=Session::get('token');

        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/thankyou',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            if(!empty($result)){
                return $result;
            }else{
                return 'Page not found';
            }
    }
}
