<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Blade::if('sayargyi',function (){
            return auth()->check() && auth()->user()->isSayarGyi();
        });
        Blade::if('casher',function (){
            return auth()->check() && auth()->user()->isCasher();
        });
        Blade::if('user',function (){
            return auth()->check() && auth()->user()->isUser();
        });
    }
}
