<?php

namespace App\Http\Controllers\ApiController;

use App\Category_child;
use App\Http\Controllers\Controller;
use App\Product;
use App\Pros_Cate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro=Product::paginate(10);
        return response()->json($pro,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json( $this->request);
        // die('333');
        $validate=Validator::make($this->request,Product::$pro_api_rules,Product::$pro_api_messages);
        if($validate->fails()){
            return response()->json($validate->errors(),400);
        }else{
            $pro=new Product();

            // custom name for category in product
            $cate_child=Category_child::all();
            // return response()->json($cate_child);
            // die('333');
            $str_cate_name='';
            foreach($cate_child as $item){
                foreach($request['cate_id'] as $jtem){
                    if($item->id==$jtem){
                        $str_cate_name .=$item->name.' <br> ';
                    }
                }
            }

            $pro->name=$this->request['name'];
            $pro->description=$this->request['des'];
            $pro->price=$this->request['price'];
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
            
              if(!empty($pro)){
                // insert pros_cate into DB
                foreach($request['cate_id'] as $item){
                    $pro_cate=new Pros_Cate();
                    $pro_cate->pro_id=$pro->id;
                    $pro_cate->cate_id=$item;
                    $pro_cate->save();
                }
                if(!empty($pro_cate)){
                    return response()->json($pro,201);
                }
                   
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       
        $pro =Product::find($id);

        return response()->json($pro,200);
    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pro=Product::find($id);
        $first_img_name=$pro->image;
        if(is_null($pro)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        if(isset($this->request['image'])){
            $file=$this->request['image'];
            $tmp_name=$file->getClientOriginalName();
            // print_r($tmp_name);
            // die('3');
            $file_name=rand(1,10000).$tmp_name;
        }
       
        //return response()->[json($file_name,404);
        if(!empty($file_name)){
            $pro_image=\public_path("/upload/ul_Admin/{$pro->image}");
            unlink($pro_image);
            

            
            //$pro->image=$file_name;
            $file->move("upload/ul_Admin",$file_name);
            $pro->update($request->all());
            $pro->image=$file_name;
            $pro->save();
            return response()->json($pro,200);
        }else{
            
            $pro->update($request->all());

            $pro->image=$first_img_name;
            $pro->save();
            return response()->json($pro,200);
        }
          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pro=Product::find($id);
        
        // Delete image
        $pro_image=\public_path("/upload/ul_Admin/{$pro->image}");
        if(!empty($pro_image)){
            unlink($pro_image);
        }
        $pro->delete();
        
        if($pro){
            $pro_cate=Pros_Cate::where('pro_id',$id)->delete();
            if($pro_cate){
                return response()->json(['message'=>'Deleted successfully'],200);
            }
        }
    }
}
