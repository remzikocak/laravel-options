<?php

namespace RKocak\Options;

use Illuminate\Support\ServiceProvider;

class OptionsServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        if (! class_exists('CreateOptiongroupsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_optiongroups_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_optiongroups_table.php'),
            ], 'migrations');
        }

        if (! class_exists('CreateOptionsTable')) {
            $this->publishes([
                __DIR__.'/../database/migrations/create_options_table.php' => database_path('migrations/'.date('Y_m_d_His', time()).'_create_options_table.php'),
            ], 'migrations');
        }

        $this->publishes([
            __DIR__.'/../config/options.php' => config_path('options.php'),
        ], 'config');
    }

    /**
     * Register services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\RKocak\Options\Contracts\Options::class, function ($app) {
            $options = new Options(
                new Loader($app['config']),
                new Types()
            );

            foreach ($app['config']->get('options.types') as $type) {
                $options->types->add($type);
            }

            return $options;
        });
    }

    /**
     * @return array|string[]
     */
    public function provides()
    {
        return [\RKocak\Options\Contracts\Options::class];
    }
}
