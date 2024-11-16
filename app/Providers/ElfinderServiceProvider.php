<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Routing\Router;

class ElfinderServiceProvider extends \Barryvdh\Elfinder\ElfinderServiceProvider
{
    public function boot(Router $router): void
    {
        $viewPath = __DIR__ . '/../resources/views';
        $this->loadViewsFrom($viewPath, 'elfinder');
        $this->publishes([
            $viewPath => base_path('resources/views/vendor/elfinder'),
        ], 'views');

        if (!defined('ELFINDER_IMG_PARENT_URL')) {
            define('ELFINDER_IMG_PARENT_URL', $this->app['url']->asset('packages/barryvdh/elfinder'));
        }

        $config = $this->app['config']->get('elfinder.route', []);
        $config['namespace'] = 'Barryvdh\Elfinder';

        $config['middleware'] = ['web', 'can:use-admin-panel'];
        $config['domain'] = config('app.domains.admin');

        $router->group($config, function ($router) {
            $router->get('/', ['as' => 'elfinder.index', 'uses' => 'ElfinderController@showIndex']);
            $router->any('connector', ['as' => 'elfinder.connector', 'uses' => 'ElfinderController@showConnector']);
            $router->get('popup/{input_id}', ['as' => 'elfinder.popup', 'uses' => 'ElfinderController@showPopup']);
            $router->get('filepicker/{input_id}', ['as' => 'elfinder.filepicker', 'uses' => 'ElfinderController@showFilePicker']);
        });
    }
}
