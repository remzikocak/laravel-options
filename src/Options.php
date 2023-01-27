<?php

namespace RKocak\Options;

use Illuminate\Support\Traits\Macroable;
use RKocak\Options\Contracts\Options as OptionsContract;

class Options implements OptionsContract
{
    use Macroable;

    /**
     * @var string
     */
    const CACHE_KEY = 'options';

    /**
     * @var array
     */
    protected array $items = [];

    /**
     * @var Loader
     */
    public Loader $loader;

    /**
     * @var Types
     */
    public Types $types;

    /**
     * Options constructor.
     *
     * @param  Loader  $loader
     * @param  Types  $types
     */
    public function __construct(Loader $loader, Types $types)
    {
        $this->loader = $loader;
        $this->types = $types;
    }

    /**
     * @param  string  $name
     * @param  null  $default
     * @return mixed|null
     */
    public function get(string $name, $default = null)
    {
        $this->loadIfNotLoaded();

        if (! $this->has($name)) {
            return $default;
        }

        return $this->items[$name];
    }

    /**
     * @param  string  $name
     * @return bool
     */
    public function has(string $name): bool
    {
        $this->loadIfNotLoaded();

        return array_key_exists($name, $this->items);
    }

    /**
     * Load option items
     */
    public function load(): void
    {
        $this->items = $this->loader->load();
        $this->loader->markAsLoaded();
    }

    /**
     * @return Types
     */
    public function getTypes(): Types
    {
        return $this->types;
    }

    /**
     * @return Loader
     */
    public function getLoader(): Loader
    {
        return $this->loader;
    }

    /**
     * @return void
     */
    protected function loadIfNotLoaded(): void
    {
        if ($this->loader->isLoaded()) {
            return;
        }

        $this->load();
    }
}
