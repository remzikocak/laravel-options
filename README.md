<p align="center"><img src="/laravel-options.png" alt="Laravel Options"></p>

# Laravel Options Package

This Package will help you to dynamically add Option fields to your Backend Panel.

## Installation
You can install the package via composer:

``` bash
composer require remzikocak/laravel-options
```

The Package will automatically register the Service Provider and Facade.
Afterwards, you need to publish and migrate:

``` bash
php artisan vendor:publish --provider="RKocak\Options\OptionsServiceProvider"
php artisan migrate
```

This will create the migration files and options.php file in your config folder.

## Usage
First of all, you need to create a Optiongroup and an Option.

``` php
use RKocak\Options\Models\Optiongroup;
use RKocak\Options\Models\Option;

Optiongroup::create([
    'label'         => 'My Optiongroup',
    'description'   => 'Optiongroup description', // can be null
    'display_order' => 1,
]);

Option::create([
    'name'          => 'myOption' // should be unique
    'label'         => 'My Option',
    'description'   => 'My awesome Option',
    'value'         => 'Option value',
    'type'          => 'text',
]);
```

Option groups and options have a many-to-many relationship. Groups can have many options, and options can belong to many groups. Understanding this relationship is essential for displaying them in your backend panel.

For assignment, use the following:
``` php
$group = Optiongroup::find(1);
$option = Option::find(1);

// Assign option to a group
$group->options()->attach($option);

// or..
$option->groups()->attach($group);
```

## Getting options
To retrieve the computed value, use the ``` getValue() ``` method from the Option Model.

``` php
$option->getValue();

// This will be the "raw" value that is stored in the database
$option->value
```

A better and more performant option is to utilize the ```Options``` Facade.
This will cache the options when you only require a key => value store.

You can use it as following:

``` php 
Options::get('optionName');

// You can pass a second parameter as default value
Options::get('optionName', null);

// or use the helper function
options('optionName', null);
```

Check if option with the given name exists
``` php
Options::has('optionName');
```

While the cache usually refreshes automatically, if you need to do it manually, use the following method.

``` php
Options::getLoader()->rebuildCache();
```

## Adding custom Types
To add your custom type, you need to create a class that extends ``` RKocak\Options\Type```

Example:
``` php
<?php

namespace App;

use RKocak\Options\Models\Option;
use RKocak\Options\Type;

class MyType extends Type
{

    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'my_type';
    }

    /**
     * @param Option $option
     * @return string
     */
    public function render(Option $option): string
    {
        return '<div>
                    <input type="text" name="options['. htmlspecialchars($option->name) .']" id="options['. htmlspecialchars($option->name) .']" value="'. htmlspecialchars($option->getValue()) .'" class=""/>
                </div>';
    }

    /**
     * Store the new value
     *
     * @param $newValue
     * @param $oldValue
     * @return mixed
     */
    public function store($newValue, $oldValue)
    {
        return $newValue;
    }

    /**
     * Cast value
     *
     * @param $value
     * @return mixed|string
     */
    public function cast($value)
    {
        return (string) $value;
    }

}
```

then add the class in configuration file to the types array.
After that you can use it like all other types.

## Rendering HTML for Edit Form
Rendering options is straightforward with a few pre-added "Types."

``` php
$option = Option::first();

$html = $option->renderEditHTML();

// ..or
$html = $option->toHtml();

// Alternatively, you can use the model instance directly in your Blade views:
{{ $option }}
```


## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
