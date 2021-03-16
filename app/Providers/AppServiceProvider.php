<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Aplikasi;

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
        $aplikasi = Aplikasi::first();
        View::share('aplikasi', $aplikasi);
    }
}
