<?php

namespace App\Http\Controllers\ApiController;

use App\Category;
use App\Category_child;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCateChildController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate=Category_child::all();
        return response()->json($cate,200);
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
        $validate=Validator::make($this->request,Category_child::$cate_child_rules,Category_child::$cate_child_message);
        if($validate->fails()){
           return response()->json($validate->errors(),400);
        }else{
            if(!empty($this->request['parent_id'])){
                $cate_id=Category::all();
                $dem=0;
                foreach ($cate_id as $item){
                    if($item->id==$this->request['parent_id']){
                        $dem++;
                    }
                }
                if($dem>0){
                    $cate_child=new Category_child();
                        $cate_child->name=$this->request['name'];
                        $cate_child->description=$this->request['des'];
                        $cate_child->parent_id=$this->request['parent_id'];
                        
                        $cate_child->save();
                        if(!empty($cate_child)){
                            return response()->json($cate_child,201);
                        }
                }else{
                    return response()->json(['parent_id'=>'parent_id không hợp lệ'],400);
                } 
            }else{
                return response()->json(['parent_id'=>'parent_id không được để trống'],400);
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
        $cate=Category_child::find($id);
        return response()->json($cate,200);
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
        $cate=Category_child::find($id);
        if(is_null($cate)){
            return response()->json(['message'=>'Record not found!'],404);

        }

        if(!empty($this->request['parent_id'])){
            $cate_id=Category::all();
            $dem=0;
            foreach ($cate_id as $item){
                if($item->id==$this->request['parent_id']){
                    $dem++;
                }
            }
            if($dem>0){
                $cate->update($request->all());
                return response()->json($cate,200);
            }else{
                return response()->json(['parent_id'=>'parent_id không hợp lệ'],400);
            } 
        }else{
            $cate->update($request->all());
            return response()->json($cate,200);
        }
        // $cate->name=$this->request['name'];
        // $cate->status=$this->request['status'];
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate=Category_child::find($id);
        if(is_null($cate)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        $cate->delete();
        return response()->json(['message'=>'Deleted successfully'],200);
    }
}
