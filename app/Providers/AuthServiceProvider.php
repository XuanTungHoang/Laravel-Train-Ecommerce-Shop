<?php

namespace App\Providers;

use App\Category;
use App\Category_child;
use App\Policies\CateChildPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Product;
use Laravel\Passport\Passport;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Category::class=>CategoryPolicy::class,
        Category_child::class=>CateChildPolicy::class,
        User::class=>UserPolicy::class,
        Product::class=>ProductPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        // admin -> all page
        Gate::before(function($user){
            if($user->role==='Admin'){
                return true;
            }
        });

        Passport::routes();
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(2));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
        // $startTime=date("Y-m-d H:i:s");
        // $endTime=date("Y-m-d H:i:s",strtotime('+7 day +1 hour +30 minutes +45seconds',strtotime($startTime)));
        // $expTime=\DateTime::createFromFormat("Y-m-d H:i:s",$endTime);
        // Passport::tokenExpireIn($expTime);
        // editor -> page edit
        // Gate::define('editor',function($user){
        //     return $user->role==='Editor';
        // });
    }
}
