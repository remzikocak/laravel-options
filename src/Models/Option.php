<?php


namespace RKocak\Options\Models;


use Illuminate\Database\Eloquent\Model;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Optiongroup::class, 'option_optiongroup');
    }

}