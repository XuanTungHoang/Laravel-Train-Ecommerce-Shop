<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
class ApiPageController extends Controller 
{
   
 
    public function product_cate($cate_parent_id, Request $request){
        
        
        $all_cate_child=DB::table('category_child')->select('category_child.name','category_child.id')->get();
        $product_from_cate=DB::table('categories')->join('category_child','categories.id','=','category_child.parent_id')
                                                  ->join('pros_cats','category_child.id','=','pros_cats.cate_id')
                                                  ->join('products','pros_cats.pro_id','=','products.id')
                                                  ->select('products.*')
                                                  ->where('categories.id','=',$cate_parent_id)
                                                  ->get();
                                            
        

        $breadcrumb=DB::table('categories')->select('categories.name','categories.id')->where('categories.id','=',$cate_parent_id)->get();
        // print_r($product_from_cate);
        // die('3');
        $this->dataSendView['list_cate_child']=$all_cate_child;
        $this->dataSendView['product_from_category']=$product_from_cate;
        $this->dataSendView['breadcrumb']=$breadcrumb;
        //$this->dataSendView['accessToken']=$accessToken;
        
        return $this->dataSendView;
    }

    public function home_view(){
        // $token=Session::get('token');
        // print_r($token);
        // die('555');

        $product_gender_is_male=DB::table('products')->where('gender','=','Nam')->orWhere('gender','=','Nam-Nữ')->orderByDesc('id')->paginate(6);
        $product_gender_is_female=DB::table('products')->where('gender','=','Nữ')->orWhere('gender','=','Nam-Nữ')->orderByDesc('id')->paginate(6);
        $this->dataSendView['male']=$product_gender_is_male;
        $this->dataSendView['female']=$product_gender_is_female;
        //$this->dataSendView['json']=$json;
        return $this->dataSendView;
    }

    public function product_cate_child($cate_child_id){
        $all_cate_child=DB::table('category_child')->select('category_child.name','category_child.id')->get();

        $product_from_cate_child=DB::table('category_child')->join('pros_cats','category_child.id','=','pros_cats.cate_id')
                                                            ->join('products','pros_cats.pro_id','=','products.id')
                                                            ->select('products.*')
                                                            ->where('category_child.id','=',$cate_child_id)
                                                            ->get();
        $breadcrumb_1=DB::table('category_child')->join('categories','category_child.parent_id','=','categories.id')
                                                ->where('category_child.id','=',$cate_child_id)
                                                ->select('categories.name','categories.id')
                                                ->get();
        $breadcrumb_2=DB::table('category_child')->select('category_child.name','category_child.id')->where('category_child.id','=',$cate_child_id)->get(); 
        $this->dataSendView['product_from_category']=$product_from_cate_child;

        // print_r($breadcrumb_1);
        // die('3');
        $this->dataSendView['list_cate_child']=$all_cate_child;
        $this->dataSendView['breadcrumb']=$breadcrumb_1;
        $this->dataSendView['breadcrumb_child']=$breadcrumb_2;
        return $this->dataSendView;
    }

    public function product_detail($pro_id){
        $all_cate_child=DB::table('category_child')->select('category_child.name','category_child.id')->get();

        $product_detail=DB::table('products')->join('pros_cats','products.id','=','pros_cats.pro_id')
                                                ->join('category_child','category_child.id','=','pros_cats.cate_id')
                                                ->join('categories','category_child.parent_id','=','categories.id')
                                                ->select('products.*','category_child.name as child','categories.name as parent','category_child.id as child_id')
                                                ->where('products.id','=',$pro_id)
                                                ->get();
      
        $related_pro=DB::table('category_child')->join('pros_cats','category_child.id','=','pros_cats.cate_id')
                                                            ->join('products','pros_cats.pro_id','=','products.id')
                                                            ->select('products.*')
                                                            ->where('category_child.id','=',$product_detail[0]->child_id)
                                                            ->paginate(5);


        // Alt image for product
        $alt_image=DB::table('product_images')->select('product_images.alt_image')->where('product_images.pro_id',$product_detail[0]->id)->get();

       
        $this->dataSendView['list_cate_child']=$all_cate_child;
        $this->dataSendView['alt_image']=$alt_image;
        $this->dataSendView['pro_detail']=$product_detail;
        $this->dataSendView['related_pro']=$related_pro;
        // print_r($related_pro);
        // die('3');
        return $this->dataSendView;
    }

    public function add_from_home($pro_id){
         // san pham chua co trong cart
         $product=DB::table('products')->where('id',$pro_id)->get();
         $product=$product[0];
         //dd($product->price);
         $product_isset=DB::table('cart')->where('pro_id',$pro_id)->get();

         return ['product'=>$product,'product_isset'=>$product_isset];
 
    }

    public function delete_cart_item($cart_id){
        $delete_cart_item=DB::table('cart')->where('id',$cart_id)->delete();
        if($delete_cart_item){
            return ['status'=>'Delete sucessfully'];
        }
    }

    public function cart_detail(){
        $cart_items=DB::table('cart')->get();
        return ['cart_items'=>$cart_items];
    }

    public function add_from_detail($pro_id){
        // $product=DB::table('products')->where('id',$pro_id)->get();
        // $product=$product[0];
        //dd($product->price);
        $product_isset=DB::table('cart')->where('pro_id',$pro_id)->get();

        return ['product_isset'=>$product_isset];

    }

    public function update_cart_detail(){
        return ['status'=>'Allows'];
    }

    public function get_checkout(){
        return ['status'=>'Allows'];
    }

    public function post_checkout(){
        $cart_items=DB::table('cart')->get();
        return ['cart_items'=>$cart_items];
    }

    public function thankyou(){
        return ['status'=>'Thank you for shopping'];
    }

    public function test(Request $request){
        //  return $request->all();
        if($request['quantity']>1){
            $update=DB::table('cart')->where('pro_id',$request['pro_id'])->update(['quantity'=>$request['quantity']]);
            if($update){
                return ['status'=>'success'];
    
            }
        }else{
            $add_to_cart=DB::table('cart')->insert(['pro_id'=>$request['pro_id'],'name'=>$request['name'],'price'=>$request['price'],
                                            'size'=>$request['size'],'quantity'=>$request['quantity'],'image'=>$request['image']]);

            if($add_to_cart){
                return ['status'=>'success'];                       
            }
        }  
    }
}
