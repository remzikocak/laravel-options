<?php


namespace RKocak\Options\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RKocak\Options\Traits\WithOptionsType;

class Option extends Model
{
    use WithOptionsType;

    /**
     * @var string
     */
    protected $table = 'options';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(config('options.models.optiongroup'), 'option_optiongroup');
    }

}