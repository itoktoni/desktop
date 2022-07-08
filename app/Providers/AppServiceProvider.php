<?php

namespace App\Providers;

use App\Dao\Models\Routes;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Plugins\Template;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('routes_facades', function () {
            return new Routes();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        share(['access' => Template::Routes()]);
        Paginator::defaultView('vendor/pagination/custom');
    }
}
