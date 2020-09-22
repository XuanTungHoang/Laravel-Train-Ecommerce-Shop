<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
//$cate=Category::all()->pluck('id')->toArray();
$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,      
        'description'=>Str::random(50),
        'price'=>rand(10000,100000),
        'image'=>'no data',
        'cate_id'=>$faker->randomElement(Category::all()->pluck('id')->toArray()),
        'status'=>'publish',
    ];
});
