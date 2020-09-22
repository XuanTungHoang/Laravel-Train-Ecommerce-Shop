<?php

namespace App\Http\Controllers;

use App\Category;
use App\Policies\CategoryPolicy;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

   
    public function index(Category $category){
        
            $this->authorize('view',$category);
            $auth_log=Auth::user();
            Log::channel('view_Log')->info('View list category parent from user: '.$auth_log->name);

            $this->dataSendView['breadcrumb']='Category list';

            $cate=Category::orderBy('created_at','desc')->paginate($this->limit);
            $this->dataSendView['cate']=$cate;
       
            return $this->admin_View('admins/pages/category/index');
      
        
    }

    public function get_Create(Category $category){

        $this->authorize('create',$category);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page create new category parent from user: '.$auth_log->name);

        $cate=new Category();
        $this->dataSendView['breadcrumb']='Create new category';
        $this->dataSendView['cate']=$cate;
        return $this->admin_View('admins/pages/category/create');
        
    }

    public function post_Create(){
        // print_r($this->request);
        // die ('3');  
        
        $validate=Validator::make($this->request,Category::$cate_rules,Category::$cate_message);
        if($validate->fails()){
            $auth_log=Auth::user();
            Log::channel('create_Log')->info('Fail create category parent from user: '.$auth_log->name);
            return redirect(action('CategoryController@get_Create'))->withInput()->withErrors($validate->errors()->all());
        }else{
            $cate=new Category();
            $cate->name=$this->request['name'];
            $cate->status='publish';
            $cate->save();
            if(!empty($cate)){
                $auth_log=Auth::user();
                Log::channel('create_Log')->info('Created new category parent id='.$cate->id.' from user: '.$auth_log->name);
                return redirect(action('CategoryController@index'))->with(['notification'=>'Thêm thành công','id_submit'=>$cate->id]);
            }
            
        }

    }

    public function get_Edit($id,Category $category){
        
        $this->authorize('update',$category);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page edit category parent with id='.$id.' from user: '.$auth_log->name);

        $this->dataSendView['breadcrumb']='Edit category';
        $cate=Category::find($id);
       
        $this->dataSendView['cate']=$cate;
        return $this->admin_View('admins/pages/category/edit');
        
    }

    public function post_Update($id, Category $category){
        // print_r($this->request);
        // die('3');
        $this->authorize('update',$category);
        $cate=Category::find($id);
        //$this->authorize($cate,'update');
        $validate=Validator::make($this->request,Category::$cate_rules,Category::$cate_message);
        if($validate->fails()){

            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Fail edit category parent with id='.$id.' from user: '.$auth_log->name);
            if(!empty($this->request['name'])){
                if($this->request['name']!=$cate->name){
                    $cate->name=$this->request['name'];
                }
            }else{
                $cate->name='';
            }
            $this->dataSendView['breadcrumb']='Edit category';        
            $this->dataSendView['cate']=$cate;
            $this->dataSendView['errors']=$validate->errors()->all();
            return $this->admin_View('admins/pages/category/edit');
            //return redirect('/admin/category/edit/'.$id)->withInput()->withErrors($validate->errors()->all());
        }else{
            
            $cate->name=$this->request['name'];
            $cate->update();
            if(!empty($cate)){
                $auth_log=Auth::user();
                Log::channel('edit_Log')->info('Updated category parent with id=' .$id. ' from user: '.$auth_log->name);
                return redirect(action('CategoryController@index'))->with(['notification'=>'Sửa thành công','id_submit'=>$cate->id]);
            }
        }
    }

    public function get_Delete($id,Category $category){
        // print_r('id='.$id);
        $this->authorize('delete',$category);

        $auth_log=Auth::user();
        Log::channel('delete_Log')->info('Deleted category parent id='.$id.' from user: '.$auth_log->name);

        $cate=Category::find($id);
        $cate->delete();

        return redirect(action('CategoryController@index'))->with(['notification'=>'Xóa thành công']);
        
    }
}
