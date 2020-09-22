<?php

namespace App\Http\Controllers;

use App\Mail\MyMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Monolog\Logger;

class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->user=Auth::user();
    //     view()->share('user_Login',$this->user);
    //     $this->middleware('auth');
    // }

    public function index(User $auth)
    {
        $this->authorize('view',$auth);
        // logging
        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View list user from user: '.$auth_log->name);
        $user=User::orderBy('created_at','desc')->paginate($this->limit);
        $this->dataSendView['user']=$user;
        $this->dataSendView['breadcrumb']='User List';
        
        // print_r($user);
        // die('3');
        return $this->admin_View("admins/pages/user/index");
    }

    public function get_Create(User $auth){
        $user= new User();
        $this->authorize('create',$auth);
        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page create new user from user: '.$auth_log->name);
        $this->dataSendView['breadcrumb']='Create new user';
        $this->dataSendView['user']=$user;
        // print_r($this->request);
        // die ('3');

        return $this->admin_View("admins/pages/user/create");
    }

    public function post_Create(){

        // print_r($this->request);
        // die ('3');
        $validate=Validator::make($this->request,User::$user_rules,User::$user_messages);
        if($validate->fails()){
            $auth_log=Auth::user();
            Log::channel('create_Log')->info('Fail create user from user: '.$auth_log->name);
            
            return redirect(action('UserController@get_Create'))->withInput()->withErrors($validate->errors()->all());
        }else{
            $user=new User();
            $user->name=$this->request['name'];
            $user->email=$this->request['email'];
            $user->password=Hash::make($this->request['password']);
            $user->role=$this->request['role'];
            $user->status='publish';
            //$user->save();

            // print_r($user);
            // die('3');
            // $user_send=$user->toArray();
            // $user_send['link']=Str::random(30);
            // DB::table('user_activations')->insert(['id_user'=>$user_send['id'],'token'=>$user_send['link']]);
            // Mail::send('mail.activation',$user_send,function($message) use ($user_send){
            //     $message->to($user_send['email']);
            //     $message->subject('Laravel training - Activation Code');
            // });

            // mail
            //$str=Str::random(10);
            // $mymail=new MyMail(
            //     $subject='Wellcom',
            //     $content='Please active your mail'
            // );

            // Mail::to($user->email)->send($mymail);

            $user->save();
            if(!empty($user)){
                $auth_log=Auth::user();
                Log::channel('create_Log')->info('Created new user id='.$user->id.' from user: '.$auth_log->name);
                return redirect(action('UserController@index'))->with(['notification'=>'Thêm thành công','id_submit'=>$user->id]);
            }
        }
    }


    // public function check_Activation($token){
    //     $check=DB::table('user_activations')->where('token',$token)->first();

    //     if(!is_null($check)){
    //         $user=User::find($check->id_user);
    //         if($user->is_activated==1){
    //             return redirect(action('UserController@index'))->with(['notification'=>'Tai khoan da duoc kich hoat','id_submit'=>$user->id]);
    //         }
    //         $user->update(['is_activations'=>1]);
    //         DB::table('user_activations')->where('token',$token)->delete();
    //         return redirect(action('UserController@index'))->with(['notification'=>'Kich hoat thanh cong','id_submit'=>$user->id]);
    //     }else{
    //         return redirect(action('UserController@index'))->with(['notification'=>'Sai token','id_submit'=>$user->id]);
    //     }
    // }

    public function get_Edit($id,User $auth){
        // print_r($id);
        // die('3');
        $this->authorize('update',$auth);
        if(!empty($id)){
            $auth_log=Auth::user();
            Log::channel('view_Log')->info('View page edit user with id='.$id.' from user: '.$auth_log->name);
            $this->dataSendView['breadcrumb']='Edit information of user';
           // $user = new User();
            $user=User::find($id);
            $this->dataSendView['user']=$user;
            // print_r($this->dataSendView['user']);
            // die ('3');
        }      
        return $this->admin_View("admins/pages/user/edit");
    }

    public function post_Update($id,User $auth){
        //$this->request['id'] = $id;
        // print_r($this->request);
        // die ("3");
        $this->authorize('update',$auth);
        $user  = User::find($id);
        $validate=Validator::make($this->request,User::$user_rules,User::$user_messages);
        if($validate->fails()){
            // print_r($validate->errors()->all());
            // die ('3');
            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Fail edit user with id='.$id.' from user: '.$auth_log->name);
            if(!empty($this->request['name'])){
                if($this->request['name']!=$user->name){
                    $user->name=$this->request['name'];
                }
            }else{
                $user->name='';
            }
            if(!empty($this->request['email'])){
                if($this->request['email']!=$user->email){
                    $user->email=$this->request['email'];
                }
            }else{
                $user->email='';
            }
            if(!empty($this->request['password'])){
                if($this->request['password']!=$user->password){
                    $user->password=$this->request['password'];
                }
            }else{
                $user->password='';
            }
            if(!empty($this->request['role'])){
                if($this->request['role']!=$user->role){
                    $user->role=$this->request['role'];
                }
            }else{
                $user->role='';
            }
            $this->dataSendView['breadcrumb']='Edit user';        
            $this->dataSendView['user']=$user;
            $this->dataSendView['errors']=$validate->errors()->all();
            return $this->admin_View('admins/pages/user/edit');
           // return redirect('admin/user/edit/'.$id)->withInput()->withErrors($validate->errors()->all());

        }else{
            
            $user->name = $this->request['name'];
            $user->password =Hash::make($this->request['password']);
            $user->email = $this->request['email'];
            $user->role = $this->request['role'];
            $user->update();
            if(!empty($user)){
                $auth_log=Auth::user();
                Log::channel('edit_Log')->info('Updated user id=' .$user->id. ' from user: '.$auth_log->name);
                return  redirect(action("UserController@index"))->with(['notification'=>"Sửa Thành Công",'id_submit'=>$id]);
            }
        }
    }

    public function get_Delete($id,User $auth){

        // print_r($id);
        // die ('3');
        $this->authorize('delete',$auth);
        $user=User::find($id);
        $user->delete();

        $auth_log=Auth::user();
        Log::channel('delete_Log')->info('Deleted user id='.$id.' from user: '.$auth_log->name);
        
        return redirect(action("UserController@index"))->with('notification','Xóa thành công');
    }
}
