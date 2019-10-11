<?php
namespace MMHK\GA;


use Illuminate\Support\ServiceProvider;

class GoogleAnalyticsEmbedServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $packageConfigFile = __DIR__.'/config.php';
        $packageCSSFile = __DIR__.'/assets/ga-embed.css';
        $packageJSFile = __DIR__.'/assets/ga-embed.js';

        $this->publishes([
            $packageConfigFile => config_path('ga-embed.php'),
        ], 'config');

        $this->publishes([
            $packageCSSFile => public_path('assets/ga-embed/ga-embed.css'),
            $packageJSFile => public_path('assets/ga-embed/ga-embed.js'),
            __DIR__ . '/assets/key.json' => base_path('resources/key.json'),
        ], 'resources');

        $this->loadViewsFrom(__DIR__ . '/views', 'ga-embed');
    }

    public function register()
    {
        $packageConfigFile = __DIR__.'/config.php';

        $this->mergeConfigFrom(
            $packageConfigFile, 'ga-embed'
        );

        $this->app->bind('GAEmbed', function (){
            return new GoogleService(config('ga-embed'));
        });
    }


}