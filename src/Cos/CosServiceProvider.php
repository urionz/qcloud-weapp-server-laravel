<?php
namespace Urionz\Qcloud\Cos;

use Illuminate\Support\ServiceProvider;
use Qcloud_cos\Conf;

class CosServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->handleConfigs();
    }

    public function register()
    {
        $this->app->singleton('qcloud.cos', function($app){
            //
        });
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../../config/qcloud.php';

        $this->publishes([
            $configPath => config_path('qcloudcos.php')
        ]);

        $this->mergeConfigFrom($configPath, 'qcloudcos');
    }
}