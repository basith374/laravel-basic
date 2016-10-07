<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\Setting;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        View::composer('layout', function($view) {
            $settings = Setting::lists('value', 'name');
            $view->with('settings', $settings);
        });
    }
}
