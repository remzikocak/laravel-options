<?php

namespace RKocak\Options\Tests;

use Illuminate\Support\Facades\Cache;
use RKocak\Options\Options;

class OptionsLoaderTest extends TestCase
{
    public function test_it_loads_from_database_if_options_are_not_cached()
    {
        $this->assertFalse(Cache::has(Options::CACHE_KEY));

        Cache::shouldReceive('has')->once();
        Cache::shouldReceive('forget')->once();
        Cache::shouldReceive('rememberForever')->once();

        $options = $this->getOptionsInstance();
        $options->load();
    }

    public function test_it_deletes_cache_if_wanted()
    {
        $options = $this->getOptionsInstance();
        $options->load();

        $this->assertTrue($options->loader->isCached());

        $options->loader->forgetCache();

        $this->assertFalse($options->loader->isCached());
    }
}
