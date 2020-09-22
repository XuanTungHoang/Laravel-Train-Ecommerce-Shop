<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $dataSendView=[];
    protected $request =[];
    
    public function __construct()
    {
        //$this->check_Login();
        //view()->share('user_Login',Auth::user());
        $this->request=request()->all();
        $this->limit=5;
    }

    protected function admin_View($path){
        return view($path,$this->dataSendView);
    }

   
    // public function check_Login(){

    //    // $user=Auth::user();
    //     if(Auth::check()){
    //         view()->share('user_Login',Auth::user());
    //     }
    // }

    

}
