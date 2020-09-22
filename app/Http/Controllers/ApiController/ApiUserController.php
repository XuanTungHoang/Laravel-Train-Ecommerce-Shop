<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user=User::all();
        return response()->json($user,200);
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
        $validate=Validator::make($this->request,User::$user_rules,User::$user_messages);
        if($validate->fails()){
           return response()->json($validate->errors(),400);
        }else{
            $user=new User();
            $user->name=$this->request['name'];
            $user->email=$this->request['email'];
            $user->password=Hash::make($this->request['password']);
            $user->role=$this->request['role'];
            $user->status='publish';
            $user->save();
            if(!empty($user)){
                return response()->json($user,201);
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
        $user=User::find($id);
        return response()->json($user,200);
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
        $user=User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        $user->update($request->all());
        return response()->json($user,200);
        
        // $validate=Validator::make($this->request,User::$user_rules,User::$user_messages);
        // if($validate->fails()){
        //    return response()->json($validate->errors(),400);
        // }else{
        //     $user=User::find($id);
        //     $user->name=$this->request['name'];
        //     $user->email=$this->request['email'];
        //     $user->password=Hash::make($this->request['password']);
        //     $user->role=$this->request['role'];
        //     $user->status='publish';
        //     $user->update();
        //     if(!empty($user)){
        //         return response()->json($user,201);
        //     }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        if(is_null($user)){
            return response()->json(['message'=>'Record not found!'],404);

        }
        $user->delete();
        return response()->json(['message'=>'Deleted successfully'],200);
    }
}
