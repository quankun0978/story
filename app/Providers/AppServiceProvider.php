<?php

namespace App\Providers;

use App\View\Components\Forms\Input;
use App\View\Components\nav;
use Carbon\Carbon;
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
        Carbon::setLocale('vi');
        Blade::component('package-input', Input::class);
        Blade::component('package-nav', nav::class);
        Paginator::useBootstrapFour();
    }
}
