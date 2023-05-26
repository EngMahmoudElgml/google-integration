<?php

namespace EngMahmoudElgml\GoogleIntegration\Providers;

use EngMahmoudElgml\GoogleIntegration\GoogleConnection;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\ServiceProvider;

class GoogleServiceProvide extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('googleIntegration', function($app) {
            return new GoogleConnection();
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'\..\config\google.php' =>  config_path('google.php'),
        ], 'config');


        $this->loadRoutesFrom(__DIR__.'\..\..\routes\web.php');
    }


}
