<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// // Route::group(['middleware'=>'auth:api'],function(){
//     Route::post('apiLogin','ApiController\LoginController@login');
//     Route::apiResource('user','ApiController\ApiUserController');
//     Route::apiResource('category','ApiController\ApiCategoryrController');
//     Route::apiResource('cate_child','ApiController\ApiCateChildController');
//     Route::apiResource('product','ApiController\ApiProductController');
// // });
//Route::apiResource('user','ApiController\ApiUserController');



    // Route::get('apiLogin','ApiController\LoginController@login');
    // Route::post('apiLogin','ApiController\LoginController@post_login');
     //Route::post('apiLogout','ApiController\LoginController@logout');
    
    Route::group(['middleware'=>'auth:api'],function(){
        
        Route::apiResource('user','ApiController\ApiUserController');
        Route::apiResource('category','ApiController\ApiCategoryrController');
        Route::apiResource('cate_child','ApiController\ApiCateChildController');
        Route::apiResource('product','ApiController\ApiProductController');

        Route::get('home-view','ApiController\ApiPageController@home_view');
       // Route::get('home-view2','ApiController\ApiPageController@home_view');
        Route::get('product-from-category/{cate_parent_id}','ApiController\ApiPageController@product_cate');
        Route::get('product-from-cate-child/{cate_child_id}','ApiController\ApiPageController@product_cate_child');
        Route::get('product-detail/{pro_id}','ApiController\ApiPageController@product_detail');

        Route::get('add-from-home/{pro_id}','ApiController\ApiPageController@add_from_home');
        Route::get('delete-cart-item/{cart_id}','ApiController\ApiPageController@delete_cart_item');
        Route::get('cart-detail','ApiController\ApiPageController@cart_detail');
        Route::get('add-from-detail/{pro_id}','ApiController\ApiPageController@add_from_detail');
        Route::get('update-cart-detail','ApiController\ApiPageController@update_cart_detail');

        Route::get('get-checkout','ApiController\ApiPageController@get_checkout');
        Route::get('post-checkout','ApiController\ApiPageController@post_checkout');
        Route::get('thankyou','ApiController\ApiPageController@thankyou');

        Route::post('test','ApiController\ApiPageController@test');
        
    });
    
    // Login
    //  // Home page
    Route::get('/','PageController@home_view');
     // Get product with category
     Route::get('api-category/{cate_parent_id}','PageController@product_cate');
     Route::get('api-cate-child/{cate_child_id}','PageController@product_cate_child');
     Route::get('api-pro-detail/{pro_id}','PageController@product_detail');

     // Cart
  //   Route::get('api-add-from-home/{pro_id}','CartController@add_from_home');
  //   Route::get('api-delete-cart-item/{cart_id}','CartController@delete_cart_item');
     Route::get('api-cart-detail','CartController@json_cart_detail');

     Route::get('api-add-from-detail/{pro_id}','CartController@api_add_from_detail');
  //   Route::post('api-update-cart-detail','CartController@update_cart_detail');

     Route::get('api-get-checkout','OrderController@json_cart_detail');
   //  Route::post('api-post-checkout','OrderController@post_checkout');
     Route::get('api-thankyou','OrderController@json_thankyou');
       




