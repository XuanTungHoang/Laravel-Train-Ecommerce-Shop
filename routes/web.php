<?php

use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$prefixAdmin ="admin";

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/cate',function(){
//     return view('clients/pages/category/index');
// });

// Route::get('admin',function(){
//     return view('admins/pages/home/index');
// });
// Route::get('admin/login','Auth\LoginController@get_Login');
// Route::post('admin/login','Auth\LoginController@post_Login');

// Route::get('admin/logout','Auth\LoginController@logout');

// Cancel
// Route::get('/login','AuthController@login');
// Route::post('/login','AuthController@sigin');


//View composer to get cart all view
View::composer(['*'],function($view){
    $cart_items=DB::table('cart')->get();
    $count_product=DB::table('cart')->count();
    $total=0;
    foreach ($cart_items as $item){
        $total+=($item->price)*($item->quantity);
    }
    $view->with(['cart_items'=>$cart_items,'total'=>$total,'count'=>$count_product]);
});

Route::group(['prefix'=>$prefixAdmin],function(){

    // HomeController
    Route::get('/','HomeController@index')->name('home');

    // UserController
    Route::group(['prefix'=>"user"],function(){
        // User index
        Route::get('/','UserController@index');
        // User create
        Route::get('create','UserController@get_Create');
      //  Route::get('create/activation/{token}','UserController@check_activation');
        Route::post('create','UserController@post_Create');
        //User edit
        Route::get('edit/{id}','UserController@get_Edit');
        Route::post('edit/{id}',['as' => 'user.post_Update', 'uses' => 'UserController@post_Update']);
        // User delete
        Route::get('delete/{id}','UserController@get_Delete');
    });

    // CategoryController
    Route::group(['prefix'=>"category"],function(){
        // Category index
        Route::get('/','CategoryController@index'); 
        // Category create
        Route::get('create','CategoryController@get_Create');
        Route::post('create','CategoryController@post_Create');
        // Category edit
        Route::get('edit/{id}','CategoryController@get_Edit');
        Route::post('edit/{id}',['as' => 'cate.post_Update', 'uses' => 'CategoryController@post_Update']);
        // Category delete
        Route::get('delete/{id}','CategoryController@get_Delete');
    });

    // ProductController
    Route::group(['prefix'=>"product"],function(){
        // Product index
        Route::get('/','ProductController@index');
        // Product create
        Route::get('create','ProductController@get_Create');
        Route::post('create','ProductController@post_Create');
        // Product edit
        Route::get('edit/{id}','ProductController@get_Edit');
        Route::post('edit/{id}',['as' => 'product.post_Update', 'uses' => 'ProductController@post_Update']);
        // Product delete
        Route::get('delete/{id}','ProductController@get_Delete');
        // Product alt image
        Route::get('add_images/{id}','ProductController@add_images');
        Route::post('post_images','ProductController@post_images');
        Route::get('delete_image/{id}','ProductController@delete_image');
        // Product detail - quantity and size
        Route::get('detail/{id}','ProductController@add_detail');
        Route::post('post_detail','ProductController@post_detail');
    });

    // CateChildController
    Route::group(['prefix'=>"catechild"],function(){
        // Category index
        Route::get('/','CateChildController@index'); 
        // Category create
        Route::get('create','CateChildController@get_Create');
        Route::post('create','CateChildController@post_Create');
        // Category edit
        Route::get('edit/{id}','CateChildController@get_Edit');
        Route::post('edit/{id}',['as' => 'catechild.post_Update', 'uses' => 'CateChildController@post_Update']);
        // Category delete
        Route::get('delete/{id}','CateChildController@get_Delete');
    });


});



Auth::routes();
Route::get('admin/home', 'HomeController@index')->name('home');
Route::post('logout','Auth\LoginController@logout')->name('logout');


//Route for client pages

// Login ?
//Route::get('apiLogin','ApiController\LoginController@login');
Route::get('apiLogin','ApiController\LoginController@get_login');

// // Home page
 Route::get('/','PageController@api_home_view');

// Get product with category
Route::get('category/{cate_parent_id}',['as'=>'categories','uses'=>'PageController@api_product_cate']);
Route::get('cate-child/{cate_child_id}',['as'=>'cate_child','uses'=>'PageController@api_product_cate_child']);
Route::get('pro-detail/{pro_id}',['as'=>'product_detail','uses'=>'PageController@api_product_detail']);

// Cart
Route::get('add-from-home/{pro_id}',['as'=>'add_from_home','uses'=>'CartController@add_from_home']);
Route::get('delete-cart-item/{cart_id}',['as'=>'delete_cart_item','uses'=>'CartController@delete_cart_item']);
Route::get('cart_detail',['as'=>'cart_detail','uses'=>'CartController@cart_detail']);

Route::post('add-from-detail/{pro_id}',['as'=>'add_from_detail','uses'=>'CartController@add_from_detail']);
Route::post('update-cart-detail',['as'=>'update_cart_detail','uses'=>'CartController@update_cart_detail']);

Route::get('get-checkout',['as'=>'get_checkout','uses'=>'OrderController@get_checkout']);
Route::post('post-checkout',['as'=>'post_checkout','uses'=>'OrderController@post_checkout']);
Route::get('thankyou','OrderController@thankyou');
