<?php


namespace RKocak\Options\Models;


use Illuminate\Database\Eloquent\Model;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_optiongroup');
    }

}