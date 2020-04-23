<?php


namespace RKocak\Options\Tests;


use RKocak\Options\Models\Option;
use RKocak\Options\Type;

class OptionsTest extends TestCase
{

    public function test_it_returns_option_value()
    {
        $options = $this->getOptionsInstance();
        $options->getTypes()->add(TestType::class);

        $opt = Option::create([
            'name'          => 'myAwesomeOption',
            'label'         => 'My Store Text',
            'description'   => null,
            'value'         => 'option value',
            'type'          => 'testName',
        ]);

        $options->load();

        // we are appending "store:" because its added by the store method from Type..
        $this->assertSame('store:option value', $options->get('myAwesomeOption'));
    }

    public function test_it_returns_default_value_if_the_option_does_not_exists()
    {
        $options = $this->getOptionsInstance();
        $options->load();

        $this->assertSame('defaultValue', $options->get('doesnotexists', 'defaultValue'));
    }

    public function test_it_casts_option_values()
    {
        $options = $this->getOptionsInstance();
        $options->getTypes()->add(TestType2::class);

        $opt = Option::create([
            'name'          => 'myAwesomeOption',
            'label'         => 'My Store Text',
            'description'   => null,
            'value'         => 'option value',
            'type'          => 'testName2',
        ]);

        $options->load();

        $this->assertSame(0, $options->get('myAwesomeOption'));
    }

}

class TestType extends Type
{
    public static function getName(): string
    {
        return 'testName';
    }

    public function store($newValue, $oldValue)
    {
        return 'store:' . $newValue;
    }

    public function cast($value)
    {
        return $value;
    }
}

class TestType2 extends Type
{
    public static function getName(): string
    {
        return 'testName2';
    }

    public function store($newValue, $oldValue)
    {
        return $newValue;
    }

    public function cast($value)
    {
        return (int) $value;
    }
}