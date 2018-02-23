<?php namespace SevenD\LaravelCacheBuster\Providers;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use SevenD\LaravelCacheBuster\Console\Commands\CacheBuster;

class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (file_exists(__DIR__ . 'Support/Functions.php')) {
            require_once(__DIR__ . 'Support/Helpers.php');
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
	$this->app->singleton('command.7d.cache-buster.install', function($app) {
            return new CacheBuster();
        });
        $this->commands('command.7d.cache-buster.install');
    }
}
