<?php

namespace App\Http\Controllers\ApiController;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiCategoryrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate=Category::all();
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
        $validate=Validator::make($this->request,Category::$cate_rules,Category::$cate_message);
        if($validate->fails()){
           return response()->json($validate->errors(),400);
        }else{
            $cate=new Category();
            $cate->name=$this->request['name'];
            $cate->status='publish';
            $cate->save();
            if(!empty($cate)){
                return response()->json($cate,201);
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
        $cate=Category::find($id);
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
        $cate=Category::find($id);
        if(is_null($cate)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        // $cate->name=$this->request['name'];
        // $cate->status=$this->request['status'];
        $cate->update($request->all());
        return response()->json($cate,200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cate=Category::find($id);
        if(is_null($cate)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        $cate->delete();
        return response()->json(['message'=>'Deleted successfully'],200);
    }
}
