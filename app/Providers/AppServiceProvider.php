<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Social;
use App\Models\Socials;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       
        $socials = Socials::all();
        
        View::composer('layouts.app', function ($view) use ($socials) {
            $view->with('socials', $socials);
        });
    }
}
