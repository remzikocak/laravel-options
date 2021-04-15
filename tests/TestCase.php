<?php


namespace RKocak\Options\Tests;


use Orchestra\Testbench\Concerns\WithLoadMigrationsFrom;
use RKocak\Options\Contracts\Options as OptionsContract;
use RKocak\Options\Options;
use RKocak\Options\OptionsServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    use WithLoadMigrationsFrom;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom([
            '--realpath'    => true,
            '--path'        => __DIR__ . '/migrations/',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [
            OptionsServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        $config = include __DIR__ . '/../config/options.php';
        $app['config']->set('options.types', $config['types']);
        $app['config']->set('options.models', $config['models']);
    }

    /**
     * @return Options
     */
    protected function getOptionsInstance(): Options
    {
        return $this->app->get(OptionsContract::class);
    }

}