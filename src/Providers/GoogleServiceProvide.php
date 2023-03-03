<?php

namespace EngMahmoudElgml\GoogleIntegration\Providers;

use EngMahmoudElgml\GoogleIntegration\GoogleConnection;
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
        //
    }
}
