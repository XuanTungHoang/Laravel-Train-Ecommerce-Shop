<?php

namespace App\Http\Controllers;

use App\Category;
use App\Category_child;
use App\Product;
use App\Pros_Cate;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Product $product){

        $this->authorize('view',$product);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View list product from user: '.$auth_log->name);
        $this->dataSendView['breadcrumb']='Product list';

        $pro=Product::orderBy('created_at','desc')->paginate($this->limit);
        
        $cate_child=Category_child::all();

        $this->dataSendView['pro']=$pro;
        $this->dataSendView['cate_child']=$cate_child;

        // return response()->json($cate);
        // die('3');
        return $this->admin_View('admins/pages/product/index');

    }


    public function get_Create(Product $product){
        $this->authorize('create',$product);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page create product from user: '.$auth_log->name);
        $this->dataSendView['breadcrumb']='Create new product';
        $cate_child=Category_child::all()->pluck('name','id');
        $this->dataSendView['cate_child']=$cate_child;
        $this->dataSendView['pro']=$product;
        return $this->admin_View('admins/pages/product/create');
    }

    public function post_Create(){
        // print_r($this->request);
        // die('3');
         $request=$this->request;
        // print_r($request['cate_id']);
        // die ('end');

        $validate=Validator::make($this->request,Product::$pro_rules,Product::$pro_messages);
        if($validate->fails()){

            // // 
            // if(!empty($this->request['image'])){
            //     $old_file=$this->request['image']->getClientOriginalName();
            //     // print_r($old_file);
            //     // die('3');
            // }else{
            //     $old_file=[];
            // }
            $auth_log=Auth::user();
            Log::channel('create_Log')->info('Fail create product from user: '.$auth_log->name);

            return redirect(action('ProductController@get_Create'))->withInput()->withErrors($validate->errors()->all());//->with('old_file',$old_file);
        }else{
            $pro=new Product();

            // custom name for category in product
            $cate_child=Category_child::all();
           
            $str_cate_name='';
            foreach($cate_child as $item){
                foreach($request['cate_id'] as $jtem){
                    if($item->id==$jtem){
                        $str_cate_name .=$item->name.' <br> ';
                    }
                }
            }
            // print_r($str);
            // die ('3');



            $pro->name=$this->request['name'];
            $pro->description=$this->request['des'];
            $pro->price=$this->request['price'];

            // check gender
            // if($request['gender']==='Nam'){
            //     $pro->gender='1';
            // }
            $pro->gender=$this->request['gender'];
           
            $pro->category=$str_cate_name;
            $pro->status='publish';
           

            // Upload file            
            $file=$this->request['image'];
            $tmp_name=$file->getClientOriginalName();
            // print_r($tmp_name);
            // die('3');
            $file_name=rand(1,10000).$tmp_name;
            $pro->image=$file_name;
            $file->move("upload/ul_Admin",$file_name);
            // save
            $pro->save();

            // print_r($user);
            // die('3');

            if(!empty($pro)){
                // insert pros_cate into DB
                foreach($request['cate_id'] as $item){
                    $pro_cate=new Pros_Cate();
                    $pro_cate->pro_id=$pro->id;
                    $pro_cate->cate_id=$item;
                    $pro_cate->save();
                }
                if(!empty($pro_cate)){
                    $auth_log=Auth::user();
                    Log::channel('create_Log')->info('Created new product id='.$pro->id.' from user: '.$auth_log->name);
                    return redirect(action('ProductController@index'))->with(['notification'=>'Thêm thành công','id_submit'=>$pro->id]);
                }
            }
        }
    }

    public function get_Edit($id,Product $product){
        $this->authorize('update',$product);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page edit product with id='.$id.' from user: '.$auth_log->name);

        $this->dataSendView['breadcrumb']='Edit product';

        $arr_pro_cate=[];
        $pro=Product::find($id);
        $cate_child=Category_child::all()->pluck('name','id');
        $pro_cate=Pros_Cate::select('cate_id')->where('pro_id',$id)->get();
        foreach ($pro_cate as $item){
           array_push($arr_pro_cate,$item->cate_id);
        }
    //     foreach ($cate_child as $jtem){
    //         print_r($jtem->id);
    //     }
        // print_r($pro_cate->cate_id);
        // print_r($arr);
        // die ('3');
        
        $this->dataSendView['pro_cate']=$arr_pro_cate;
        $this->dataSendView['pro']=$pro;
        $this->dataSendView['cate_child']=$cate_child;
        return $this->admin_View('admins/pages/product/edit');
    }

    public function post_Update($id,Product $product){
        $this->authorize('update',$product);

        $pro=Product::find($id);
        $cate_child=Category_child::all()->pluck('name','id');
        $request=$this->request;

        // print_r($cate_child);
        // die('3');
       
        $validate=Validator::make($this->request,Product::$pro_rules,Product::$pro_messages);
        if($validate->fails()){
            // 
            // if(!empty($this->request['cate_id'])){
            //     $pro_cate=$this->request['cate_id'];
            // }
            // print_r($pro_cate);
            // die('3');
            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Fail edit product with id='.$id.' from user: '.$auth_log->name);

            if(!empty($this->request['name'])){
               if($this->request['name']!=$pro->name){
                    $pro->name =$this->request['name'];
               }
            }else{
                $pro->name='';
            }
            if(!empty($this->request['des'])){
                if($this->request['des']!=$pro->description){
                    $pro->description=$this->request['des'];
                }
            }else{
                $pro->description='';
            }
            if(!empty($this->request['price'])){
                if($this->request['price']!=$pro->price){
                    $pro->price=$this->request['price'];
                }
            }else{
                $pro->price='';
            }
            if(!empty($this->request['gender'])){
                if($this->request['gender']!=$pro->gender){
                    $pro->gender=$this->request['gender'];
                }
            }
            if(!empty($this->request['cate_id'])){
                    $pro_cate=$this->request['cate_id'];
            }
            $this->dataSendView['breadcrumb']='Edit product';
            $this->dataSendView['cate_child']=$cate_child;
            $this->dataSendView['pro']=$pro;
            $this->dataSendView['pro_cate']=$pro_cate;
            $this->dataSendView['errors']=$validate->errors()->all();
            return $this->admin_View('admins/pages/product/edit');
        }else{

            $pro->name=$this->request['name'];
            $pro->description=$this->request['des'];
            $pro->price=$this->request['price'];
            $pro->gender=$this->request['gender'];


            $categorychild=Category_child::all();
           // category name in product
            $str_cate_name='';
            foreach($categorychild as $item){
                foreach($request['cate_id'] as $jtem){
                    if($item->id==$jtem){
                        $str_cate_name .=$item->name.' <br> ';
                    }
                }
            }
            $pro->category=$str_cate_name;
              
             // Delete old image
            $pro_image=\public_path("/upload/ul_Admin/{$pro->image}");
            unlink($pro_image);
             // Upload new image          
             $file=$this->request['image'];
            $tmp_name=$file->getClientOriginalName();
            // print_r($tmp_name);
            // die('3');
            $file_name=rand(1,10000).$tmp_name;

            //update image
            $pro->image=$file_name;
            $file->move("upload/ul_Admin",$file_name);
            // save
            $pro->save();
            // Log
            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Updated product with id='.$id.' from user: '.$auth_log->name);

             // delete pros_cate 
            $pro_cate=Pros_Cate::where('pro_id',$id)->delete();
            if($pro_cate){
                foreach($request['cate_id'] as $item){
                    $pro_cate_new= new Pros_Cate();
                    $pro_cate_new->pro_id=$id;
                    $pro_cate_new->cate_id=$item;
                    $pro_cate_new->save();
                }   
                if(!empty($pro_cate_new)){
                    return redirect(action('ProductController@index'))->with(['notification'=>'Sửa thành công','id_submit'=>$pro->id]);
                }
            }
            // print_r($pro_cate);
            // die('3');
        }       
    }

    public function get_Delete($id,Product $product){

        $this->authorize('delete',$product);

        $pro=Product::find($id);
        
        // Delete image
        $pro_image=\public_path("/upload/ul_Admin/{$pro->image}");
        unlink($pro_image);

        // Delete product
        $pro->delete();
        
        if($pro){
            $pro_cate=Pros_Cate::where('pro_id',$id)->delete();
            if($pro_cate){
                $auth_log=Auth::user();
                Log::channel('delete_Log')->info('Deleted product with id='.$id.' from user: '.$auth_log->name);
                return redirect(action("ProductController@index"))->with('notification','Xóa thành công');
            }
        }
    }

    public function add_images($pro_id,Product $product){
        $this->authorize('add_image',$product);

        $pro=Product::find($pro_id);
        $this->dataSendView['pro']=$pro;
        // print_r($pro);
        // die('3');
        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page add images for product with id='.$pro_id.' from user: '.$auth_log->name);
        return $this->admin_View('admins/pages/product/add_image');
    }

    public function post_images(Product $product){
        // dd($this->request);
        $this->authorize('add_image',$product);
        $product_id=$this->request['pro_id'];
        $pro=Product::find($product_id);
        $validate=Validator::make($this->request,Product::$role_add_image,Product::$mess_add_image);
        if($validate->fails()){
            $auth_log=Auth::user();
            Log::channel('create_Log')->info('Fail add images for product with id='.$product_id.' from user: '.$auth_log->name);
            $this->dataSendView['pro']=$pro;
            $this->dataSendView['errors']=$validate->errors()->all();
            return $this->admin_View('admins/pages/product/add_image');
        }else{
            $file=$this->request['image'];
            $tmp_name=$file->getClientOriginalName();
        // print_r($tmp_name);
        // die('3');
            $file_name=rand(1,10000).$tmp_name;
            $file->move("upload/ul_Admin",$file_name);

        
        // Add image to product_images table
            $add_image=DB::table('product_images')->insert(['pro_id'=>$product_id,'alt_image'=>$file_name]);
            if($add_image){
                $auth_log=Auth::user();
                Log::channel('create_Log')->info('Added image for product with id='.$product_id.' from user: '.$auth_log->name);
                return back();
            }
        }  
    }

    public function delete_image($img_id,Product $product){
        $this->authorize('add_image',$product);

        $img_delete=DB::table('product_images')->where('product_images.id',$img_id)->get();
        //dd($img_delete[0]->pro_id);
        // Delete image in path
        $alt_image=\public_path("/upload/ul_Admin/{$img_delete[0]->alt_image}");
        unlink($alt_image);
        // Delete image in table product_images
        $delete=DB::table('product_images')->where('product_images.id',$img_id)->delete();
        if($delete){
            $auth_log=Auth::user();
            Log::channel('delete_Log')->info('Delete image of product with id='.$img_delete[0]->pro_id.' from user: '.$auth_log->name);
            return back();
        }
    }

    public function add_detail($pro_id,Product $product){
        $this->authorize('add_image',$product);

        $pro=Product::find($pro_id);
       
        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page add detail for product with id='.$pro_id.' from user: '.$auth_log->name);
        // Get quantity form table product detail
        $quantity=DB::table('product_detail')->where('pro_id',$pro_id)->get();

        $this->dataSendView['pro']=$pro;
        $this->dataSendView['size']=$quantity;
        // print_r($quantity);
        // die('3');
        
        return $this->admin_View('admins/pages/product/add_detail');
    }

    public function post_detail(Product $product){

        // print_r($this->request);
        // die('3');
        $this->authorize('add_image',$product);

        $product_id=$this->request['pro_id'];
        $pro_detail=DB::table('product_detail')->where('pro_id',$product_id)->get();
        // print_r($pro_detail[0]->pro_id);
        //  die('3');
        // Delete old quantity neu da ton tai
        if(isset($pro_detail[0]->pro_id)){
            // print_r($this->request);
            // die('3');
            $delete_old_quantity=DB::table('product_detail')->where('pro_id',$product_id)->delete();
            if($delete_old_quantity){
                // Insert into table product detail
                $size_S=$this->request['size_S'];
                $size_M=$this->request['size_M'];
                $size_L=$this->request['size_L'];
                $size_XS=$this->request['size_XS'];
          
                $add_detail=DB::table('product_detail')->insert(['pro_id'=>$product_id,'size_S'=>$size_S,'size_M'=>$size_M,'size_L'=>$size_L,'size_XS'=>$size_XS]);
                if($add_detail){
                    $auth_log=Auth::user();
                    Log::channel('edit_Log')->info('Updated detail for product with id='.$product_id.' from user: '.$auth_log->name);
                    return back();
                }
            }
        }else{
           
            $size_S=$this->request['size_S'];
            $size_M=$this->request['size_M'];
            $size_L=$this->request['size_L'];
            $size_XS=$this->request['size_XS'];
      
            $add_detail=DB::table('product_detail')->insert(['pro_id'=>$product_id,'size_S'=>$size_S,'size_M'=>$size_M,'size_L'=>$size_L,'size_XS'=>$size_XS]);
            if($add_detail){
                Log::channel('create_Log')->info('Created detail for product with id='.$product_id.' from user: '.$auth_log->name);
                return back();
            }
        }
       
    }

}
