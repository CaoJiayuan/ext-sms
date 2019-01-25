<?php

namespace Nerio\Sms;


use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;

class SmsServiceProvider extends ServiceProvider
{

    public function register()
    {
        $source = realpath(__DIR__.'/../config/nerio-sms.php');
        if ($this->app instanceof LaravelApplication) {
            if ($this->app->runningInConsole()) {
                $this->publishes([$source => config_path('nerio-sms.php')], 'nerio-sms');
            }
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('nerio-sms');
        }
        $this->mergeConfigFrom($source, 'nerio-sms');

        $this->registerClient();
    }

    public function registerClient()
    {
        $this->app->bind('nerio.sms', function ($app) {
            return new Client($app['config']->get('nerio-sms'));
        });
    }
}
