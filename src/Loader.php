<?php

namespace RKocak\Options;

use Illuminate\Config\Repository as Config;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Loader
{
    /**
     * @var bool
     */
    protected bool $isLoaded = false;

    /**
     * @var Config
     */
    protected Config $config;

    /**
     * Loader constructor.
     *
     * @param  Config  $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function load(): array
    {
        if (! $this->isCached()) {
            $options = $this->fromDatabase();
            $this->rebuildCache($options);
        } else {
            $options = $this->fromCache();
        }

        $optionsArray = [];
        $options->each(function ($option) use (&$optionsArray) {
            $optionsArray[$option->name] = $option->getValue();

            return $option;
        });

        return $optionsArray;
    }

    /**
     * @return bool
     */
    public function isLoaded(): bool
    {
        return $this->isLoaded;
    }

    /**
     * @return Collection
     */
    public function fromDatabase(): Collection
    {
        return $this->getOptionModel()::all();
    }

    /**
     * @return Collection
     */
    public function fromCache(): ?Collection
    {
        return Cache::get(Options::CACHE_KEY);
    }

    /**
     * @return bool
     */
    public function isCached(): bool
    {
        return (bool) Cache::has(Options::CACHE_KEY);
    }

    /**
     * @return void
     */
    public function markAsLoaded(): void
    {
        $this->isLoaded = true;
    }

    /**
     * @return void
     */
    public function forgetCache(): void
    {
        Cache::forget(Options::CACHE_KEY);
    }

    /**
     * @param  Collection|null  $options
     */
    public function rebuildCache(Collection $options = null): void
    {
        if (is_null($options)) {
            $options = $this->fromDatabase();
        }

        $this->forgetCache();
        Cache::rememberForever(Options::CACHE_KEY, function () use ($options) {
            return $options;
        });
    }

    /**
     * @return string
     */
    protected function getOptionModel(): string
    {
        return $this->config->get('options.models.option');
    }

    /**
     * @return string
     */
    protected function getOptiongroupModel(): string
    {
        return $this->config->get('options.models.optiongroup');
    }
}
