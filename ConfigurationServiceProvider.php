<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
	    $env = '';
	    try {
		    $resource = stream_socket_client(
				    sprintf('tcp://%s:%s',env('CONF_SERV','127.0.0.1'),env('CONF_SERV_PORT',9876)),
				    $errno, 
				    $errstr, 
				    1, 
				    STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT
				    );
		    fwrite($resource, 'env' . "\r\n");
		    $env = fgets($resource);
	    } catch (\Exception $ex) {
		    \Log::error($ex->getMessage());
	    }

	    $configs = @json_decode($env, true) ?? [];
	    foreach ($configs as $config) {
		    putenv($config);
	    }
    }
}
