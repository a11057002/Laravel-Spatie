<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // dd($this->app);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // fix pagination css in laravel 8
        Paginator::useBootStrap();        
        // you can add Gate facades here if you want to
        // Gate::define('andy-test', function (User $user, User $post) {
        //     return $user->id === $post->id;
        // });

        // Runs before or after all other authorization check
        // Gate::before(function(){});
        // Gate::after(function(){});

        // Gate::define('andy-test', [PostPolicy::class, 'update']);
    
    }
}
