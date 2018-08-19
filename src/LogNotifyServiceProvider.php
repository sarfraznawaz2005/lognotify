<?php

namespace Sarfraznawaz2005\LogNotify;

use Illuminate\Log\Events\MessageLogged;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class LogNotifyServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'logNotify');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__ . '/Config/config.php' => config_path('logNotify.php'),
            ], 'logNotify.config');

            // Publishing the views.
            $this->publishes([
                __DIR__ . '/Views' => base_path('resources/views/vendor/logNotify'),
            ], 'logNotify.views');
        }
    }

    /**
     * Register package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/Config/config.php', 'logNotify');

        // register event handler
        Event::listen(MessageLogged::class, function (MessageLogged $e) {

            if (!config('logNotify.enabled')) {
                return false;
            }

            $levels = config('logNotify.levels');

            if (\in_array('all', $levels, true) || \in_array($e->level, $levels, true)) {

                $data = [
                    'level' => $e->level,
                    'message' => $e->message,
                    'context' => $e->context,
                ];

                $data['time'] = Carbon::now()->toTimeString();

                try {

                    $client = new \vakata\websocket\Client(config('logNotify.socket_url'));

                    $client->send(json_encode($data));

                } catch (\Exception $e) {
                }
            }

        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['logNotify'];
    }
}
