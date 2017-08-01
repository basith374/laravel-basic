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
        View::composer('admin.layout', function($view) {
            $links = [
                [
                    'text' => 'Gallery',
                    'link' => 'admin/gallery',
                    'icon' => 'glyphicon glyphicon-picture',
                ],
                [
                    'text' => 'Settings',
                    'link' => 'admin/settings',
                    'icon' => 'glyphicon glyphicon-wrench',
                ],
            ];
            $view->with('links', $links);
        });
    }
}
