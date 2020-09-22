<?php

namespace App\Http\Controllers;

use App\Category;
use App\Category_child;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CateChildController extends Controller
{
    public function index(Category_child $cate_child){
        $this->authorize('view',$cate_child);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View list category child from user: '.$auth_log->name);

        $this->dataSendView['breadcrumb']='Category child list';

        $cate_child=Category_child::orderBy('created_at','desc')->paginate($this->limit);
        $this->dataSendView['cate_child']=$cate_child;
        $cate_parent=Category::all();

        //$this->dataSendView['pro']=$pro;
        $this->dataSendView['cate_parent']=$cate_parent;

        return $this->admin_View('admins/pages/cate_child/index');
    }

    public function get_Create(Category_child $cate_child){

        $this->authorize('create',$cate_child);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page create new category child from user: '.$auth_log->name);

        $this->dataSendView['breadcrumb']='Create new category';
        $cate=Category::all()->pluck('name','id');
        $this->dataSendView['cate_parent']=$cate;
        $this->dataSendView['cate_child']=$cate_child;
        return $this->admin_View('admins/pages/cate_child/create');
    }

    public function post_Create(){
        // print_r($this->request);
        // die('3');
        // $request=$this->request;
        //$this->authorize('create',$cate_child);
        $validate=Validator::make($this->request,Category_child::$cate_child_rules,Category_child::$cate_child_message);
        if($validate->fails()){
            $auth_log=Auth::user();
            Log::channel('create_Log')->info('Fail create category child from user: '.$auth_log->name);
            return redirect(action('CateChildController@get_Create'))->withInput()->withErrors($validate->errors()->all());
        }else{
            $cate_child=new Category_child();
            $cate_child->name=$this->request['name'];
            $cate_child->description=$this->request['des'];
            $cate_child->parent_id=$this->request['parent_id'];
            
            $cate_child->save();

            // print_r($user);
            // die('3');

            if(!empty($cate_child)){
                $auth_log=Auth::user();
                Log::channel('create_Log')->info('Created new category child id='.$cate_child->id.' from user: '.$auth_log->name);
                return redirect(action('CateChildController@index'))->with(['notification'=>'Thêm thành công','id_submit'=>$cate_child->id]);
            }
        }  
    }

    public function get_Edit($id,Category_child $cate_child){
        $this->authorize('update',$cate_child);

        $auth_log=Auth::user();
        Log::channel('view_Log')->info('View page edit category child with id='.$id.' from user: '.$auth_log->name);

        $this->dataSendView['breadcrumb']='Edit category child';

        $cate_child=Category_child::find($id);
        $cate_parent=Category::all()->pluck('name','id');

        $this->dataSendView['cate_child']=$cate_child;
        $this->dataSendView['cate_parent']=$cate_parent;
        return $this->admin_View('admins/pages/cate_child/edit');
    }

    public function post_Update($id,Category_child $cate_child){

        $this->authorize('update',$cate_child);
        $cate_child=Category_child::find($id);
        $cate_parent=Category::all()->pluck('name','id');
        $validate=Validator::make($this->request,Category_child::$cate_child_rules,Category_child::$cate_child_message);
        if($validate->fails()){
            // 
            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Fail edit category child with id='.$id.' from user: '.$auth_log->name);     
            if(!empty($this->request['name'])){
               if($this->request['name']!=$cate_child->name){
                    $cate_child->name =$this->request['name'];
               }
            }else{
                $cate_child->name='';
            }
            if(!empty($this->request['des'])){
                if($this->request['des']!=$cate_child->description){
                    $cate_child->description=$this->request['des'];
                }
            }else{
                $cate_child->description='';
            }
          
            if(!empty($this->request['parent_id'])){
                if($this->request['parent_id']!=$cate_child->cate_id){
                    $cate_child->parent_id=$this->request['parent_id'];
                }
            }else{
                $cate_child->parent_id='';
            }
            $this->dataSendView['breadcrumb']='Edit category child';
            $this->dataSendView['cate_parent']=$cate_parent;
            $this->dataSendView['cate_child']=$cate_child;
            $this->dataSendView['errors']=$validate->errors()->all();
            return $this->admin_View('admins/pages/cate_child/edit');
        }else{

            $cate_child->name=$this->request['name'];
            $cate_child->description=$this->request['des'];
           
            $cate_child->parent_id=$this->request['parent_id'];
              
            $cate_child->save();

            $auth_log=Auth::user();
            Log::channel('edit_Log')->info('Updated category child with id=' .$id. ' from user: '.$auth_log->name);

            return redirect(action('CateChildController@index'))->with(['notification'=>'Sửa thành công','id_submit'=>$cate_child->id]);
            }       
    }

    public function get_Delete($id,Category_child $cate_child){

        $this->authorize('delete',$cate_child);
        $cate_child=Category_child::find($id);

        // Delete product
        $cate_child->delete();

        $auth_log=Auth::user();
        Log::channel('delete_Log')->info('Deleted category child id='.$id.' from user: '.$auth_log->name);

        return redirect(action("CateChildController@index"))->with('notification','Xóa thành công');
    }

}
