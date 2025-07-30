<?php
// app/Providers/ViewServiceProvider.php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Category; 
use App\Models\repalce;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        View::composer('Webheader', function ($view) {
            if (Auth::check()) {
                $getAuth = Auth::id();
                $getNiti = repalce::where('user_id', $getAuth)
                                  ->where('status', 'unread')
                                  ->get();
                $view->with('getNiti', $getNiti);
            } else {
                $view->with('getNiti', collect());
            }
        });
    }

    public function register(): void
    {
        //
    }
}
