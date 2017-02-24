<?php

namespace Urionz\Qcloud\Weapp;

use Illuminate\Support\ServiceProvider;
use QCloud_WeApp_SDK\Conf;
use Urionz\Qcloud\Weapp\Weapp;

class WeappServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('qcloud.weapp', function($app){
            $config = $app->config->get('qcloudweapp');
            $server_host = array_get($config, 'server_host', '');
            $auth_server_url = array_get($config, 'auth_server_url', '');
            $tunnel_server_url = array_get($config, 'tunnel_server_url', '');
            $tunnel_signature_key = array_get($config, 'tunnel_signature_key', '');
            $network_timeout = array_get($config, 'network_timeout', 3000);
            $log_enable = array_get($config, 'log_enable', true);
            $log_store_path = array_get($config, 'log_store_path', storage_path('qcloud') . '/logs/');
            $debug_level = array_get($config, 'debug_level', [2]);
            Conf::setup([
                'ServerHost' => $server_host,
                'AuthServerUrl' => $auth_server_url,
                'TunnelServerUrl' => $tunnel_server_url,
                'TunnelSignatureKey' => $tunnel_signature_key,
            ]);
            Conf::setNetworkTimeout($network_timeout);
            Conf::setEnableOutputLog($log_enable);
            Conf::setLogPath($log_store_path);
            Conf::setLogThresholdArray($debug_level);
            return new Weapp();
        });
    }

    private function handleConfigs()
    {
        $configPath = __DIR__ . '/../../config/qcloud.php';

        $this->publishes([
            $configPath => config_path('qcloudweapp.php')
        ]);

        $this->mergeConfigFrom($configPath, 'qcloudweapp');
    }
}
