<?php

namespace ChatC\WhatsAppDesk;

use Illuminate\Support\ServiceProvider;

class WhatsAppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/whatsapp.php',
            'whatsapp'
        );

        $this->app->singleton(WhatsAppService::class, function ($app) {
            return new WhatsAppService(
                config('whatsapp.appkey'),
                config('whatsapp.authkey')
            );
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/whatsapp.php' => config_path('whatsapp.php'),
        ], 'config');
    }
}
