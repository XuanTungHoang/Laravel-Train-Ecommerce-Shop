<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class CartController extends Controller
{
    public function add_from_home($pro_id){
         //dd($pro_id);
         $token=Session::get('token');
        //  print_r($token);
        //  die('3');   
         if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
             
          
        }
        $client= new Client();
        $response = $client->request('GET','localhost/learn_laravel/public/api/add-from-home/'.$pro_id,[
                         'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
        ])->getBody();
 
        $result=json_decode($response,true);
        $product=$result['product'];
        $product_isset=$result['product_isset'];
            
           
        if(!empty($product_isset)){
                
            $product_isset=$result['product_isset'];
           
            $id=$product_isset[0]['pro_id'];
            $quantity=$product_isset[0]['quantity']+1;
           
            $update_quantity=DB::table('cart')->where('pro_id',$id)->update(['quantity'=>$quantity]);
            if($update_quantity){
               // die('3');
                return back();
            }
        }else{
            $add_to_cart=DB::table('cart')->insert(['pro_id'=>$product['id'],'name'=>$product['name'],'price'=>$product['price'],'size'=>'M','quantity'=>1,'image'=>$product['image']]);
            if($add_to_cart){
                 return back();
            }   
        }
    }

    public function delete_cart_item($cart_id){
        //dd($cart_id);
        $token=Session::get('token');
        //  print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/delete-cart-item/'.$cart_id,[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            if(!empty($result)){
                return back();
            }
    }

    public function cart_detail(){
        $token=Session::get('token');
        //  print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/cart-detail',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            if(!empty($result)){
                // print_r($result);
                // die('5');
                return $this->admin_View('/clients/pages/cart/index');
            }
    }




    public function add_from_detail($pro_id){
        

        $rq_product=$this->request;
        $token=Session::get('token');
        //  print_r($rq_product['quantity']);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
           
        }
        $client= new Client();
        $response = $client->request('GET','localhost/learn_laravel/public/api/add-from-detail/'.$pro_id,[
                    'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
        ])->getBody();
    
        $result=json_decode($response,true);
        $product_isset=$result['product_isset'];
        
       
        if(!empty($product_isset)){

            $id=$product_isset[0]['pro_id'];
            $quantity=$product_isset[0]['quantity'] + $rq_product['quantity'];
       //print_r($quantity);
       
            $update_quantity=DB::table('cart')->where('pro_id',$id)->update(['quantity'=>$quantity]);
            if($update_quantity){
           
                return back();
            }
        }else{
            if(!empty($rq_product['size'])){
                $rq_product['size']=$rq_product['size'];
            }else{
                $rq_product['size']='M';
            }
            $add_to_cart=DB::table('cart')->insert(['pro_id'=>$rq_product['id'],'name'=>$rq_product['name'],'price'=>$rq_product['price'],
                                            'size'=>$rq_product['size'],'quantity'=>$rq_product['quantity'],'image'=>$rq_product['image']]);
            if($add_to_cart){
                 return back();
            }   
        }
      
    }

    public function update_cart_detail(){

        $rq_cart=$this->request;
       // dd($rq_cart);
        $token=Session::get('token');

        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/update-cart-detail',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);

            if(!empty($result)){
                $rq_id=$rq_cart['id'];
                $rq_quantity=$rq_cart['quantity'];
                $rq_size=$rq_cart['size'];
                //dd($rq_id[0]);
                $dem=0;
                foreach ($rq_id as $item){
                    $update_quantity=DB::table('cart')->where('id',$item)->update(['quantity'=>$rq_quantity[$dem],'size'=>$rq_size[$dem]]);
                    $dem++;
                }
                return back();
            }    
    }

    public function json_cart_detail(){
        $token=Session::get('token');
        //  print_r($token);
        // die('3');   
        if($token==null){
            $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
        
            
        }
        $client= new Client();
            $response = $client->request('GET','localhost/learn_laravel/public/api/cart-detail',[
                        'headers' => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer '.$token,
                    ],
            ])->getBody();
        
            $result=json_decode($response,true);
            if(!empty($result)){
                $cart_items=$result['cart_items'];
                return $cart_items;
            }else{
                return 'Giỏ hàng hiện đang trống';
            }
            
            
    }

    public function api_add_from_detail($pro_id){
       // dd($pro_id);
       $token=Session::get('token');
    //     print_r($token);
    //    die('3');   
       if($token==null){
           $token=app('App\Http\Controllers\ApiController\LoginController')->get_login();
       
           
       }
       $client= new Client();
       $quantity=0;

       $product=DB::table('products')->where('id',$pro_id)->get();
       if(empty($product[0]->id)){
            return ['status'=>'Failed !'];
       }
    //    print_r($product[0]);
    //     die('3');  
       $product_isset=DB::table('cart')->where('pro_id',$pro_id)->get();
    //    print_r($product_isset);
    //    die('3');
       if(!empty($product_isset[0]->pro_id)){
            // print_r($product_isset);
            // die('3');
            $id=$product_isset[0]->pro_id;
            $name=$product_isset[0]->name;
            $price=$product_isset[0]->price;
            $size=$product_isset[0]->size;
            $quantity=$product_isset[0]->quantity +1 ;
            $image=$product_isset[0]->image;
       }else{
            $id=$product[0]->id;
            $name=$product[0]->name;
            $price=$product[0]->price;
            $size='M';
            $quantity=1;
            $image=$product[0]->image;
       }
        // print_r($product);
        // die('3');  
        $response = $client->post('localhost/learn_laravel/public/api/test',[
                       'headers' => [
                       'Accept' => 'application/json',
                       'Content-Type' => 'application/x-www-form-urlencoded',
                       'Authorization' => 'Bearer '.$token,
                        ],
                        'form_params'=>[
                            'pro_id'=>$id,
                            'name'=>$name,
                            'price'=>$price,
                            'size'=>$size,
                            'quantity'=>$quantity,
                            'image'=>$image,
                        ]
        ]);
        
        return ['status'=>'Successfully','status_code'=>$response->getStatusCode()];
        // $response->getStatusCode();
    //    die('3'); 
       // $result=json_decode($response,true);
       
        
    }
}
