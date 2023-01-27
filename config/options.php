<?php

return [

    /*
     * Option Types
     */
    'types' => [
        RKocak\Options\Types\Text::class,
        RKocak\Options\Types\Number::class,
        RKocak\Options\Types\Email::class,
        RKocak\Options\Types\Password::class,
    ],

    /*
     * Model Map
     */
    'models' => [
        'option' => RKocak\Options\Models\Option::class,
        'optiongroup' => RKocak\Options\Models\Optiongroup::class,
    ],

];
