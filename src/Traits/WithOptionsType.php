<?php


namespace RKocak\Options\Traits;


use Illuminate\Database\Eloquent\Model;
use RKocak\Options\Exceptions\OptionTypeNotPresetException;
use RKocak\Options\Facades\Options;
use RKocak\Options\Models\Option;
use RKocak\Options\Type;

trait WithOptionsType
{

    /**
     * @var Type|null
     */
    public ?Type $optionType = null;

    /**
     * @var mixed
     */
    protected $initialValue;

    /**
     * @return void
     */
    public static function bootWithOptionsType()
    {
        static::retrieved(function(Model $model)
        {
            $attributes = $model->getAttributes();

            $model->initialValue = $attributes['value'];

            if(!$model->optionType && Options::getTypes()->has($attributes['type']))
            {
                $model->optionType = Options::getTypes()->get($attributes['type']);
            }
        });

        static::created(function(Model $model)
        {
            Options::getLoader()->rebuildCache();
        });

        static::updated(function(Model $model)
        {
            Options::getLoader()->rebuildCache();
        });

        static::creating(function(Model $model)
        {
            $model->value = $model->getStoreData();
        });

        static::updating(function(Model $model)
        {
            $model->value = $model->getStoreData();
        });
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        $this->checkOptionTypeIsSet();

        return $this->optionType->cast($this->value);
    }

    /**
     * @return mixed
     */
    public function getStoreData()
    {
        $this->checkOptionTypeIsSet();

        return $this->optionType->store($this->value, $this->initialValue);
    }

    /**
     * @return string|null
     */
    public function renderEditHTML(): ?string
    {
        return $this->optionType->render($this);
    }

    /**
     * @return void
     */
    protected function checkOptionTypeIsSet(): void
    {
        if(!$this->optionType && !empty($this->type))
        {
            $this->optionType = Options::getTypes()->get($this->type);
        }
    }
    
}