<?php

namespace Nowendwell\SimpleDatatables;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class SimpleDatatablesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'simple-datatables');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'simple-datatables');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('simple-datatables.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/simple-datatables'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/simple-datatables'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/simple-datatables'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        Response::macro('toDatatables', function ($collection, $fields = []) {

            $all_data = [];
            $field_data = [];
            foreach($collection as $item) {
                foreach($fields as $field) {
                    $field = str_replace('.', '->', $field);
                    $field_data[] = $item->{$field};
                }
                $all_data[] = $field_data;
            }

            $data = [
                'data' => $all_data,
                'draw' => 1,
                'recordsFiltered' => $collection->count(),
                'recordsTotal' => $collection->recordsTotal,
            ];

            return response()->json($data);
        });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'simple-datatables');

        // Register the main class to use with the facade
        $this->app->singleton('simple-datatables', function () {
            return new SimpleDatatables;
        });
    }
}
