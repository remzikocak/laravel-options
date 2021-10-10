<?php


namespace RKocak\Options\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Optiongroup extends Model
{

    /**
     * @var string
     */
    protected $table = 'optiongroups';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'display_order' => 'integer',
    ];

    /**
     * @return BelongsToMany
     */
    public function options(): BelongsToMany
    {
        return $this->belongsToMany(config('options.models.option'), 'option_optiongroup');
    }

}