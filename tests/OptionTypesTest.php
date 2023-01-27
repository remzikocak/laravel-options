<?php

namespace RKocak\Options\Tests;

use Illuminate\Support\Facades\Cache;
use RKocak\Options\Models\Option;
use RKocak\Options\Types\Text;

class OptionTypesTest extends TestCase
{
    public function test_it_registers_new_types()
    {
        $options = $this->getOptionsInstance();
        $options->types->add(TestType::class);

        $this->assertTrue($options->types->has('testName'));
    }

    public function test_it_registers_default_types()
    {
        $options = $this->getOptionsInstance();
        $this->assertTrue($options->types->has('text'));
    }

    public function test_it_returns_type_instance()
    {
        $options = $this->getOptionsInstance();

        $this->assertInstanceOf(Text::class, $options->types->get('text'));
    }

    public function test_it_calls_store_method_on_create_and_rebuild_cache()
    {
        Cache::shouldReceive('has');
        Cache::shouldReceive('forget');
        Cache::shouldReceive('rememberForever');

        $options = $this->getOptionsInstance();
        $options->getTypes()->add(TestType::class);
        $options->load();

        $opt = Option::create([
            'name' => 'myStoreText',
            'label' => 'My Store Text',
            'description' => null,
            'value' => '100',
            'type' => 'testName',
        ]);

        $opt->fresh();

        $this->assertSame('store:100', $opt->value);
    }

    public function test_it_calls_store_method_on_update_and_rebuild_cache()
    {
        Cache::shouldReceive('has');
        Cache::shouldReceive('forget');
        Cache::shouldReceive('rememberForever');

        $options = $this->getOptionsInstance();
        $options->getTypes()->add(TestType::class);
        $options->load();

        $opt = Option::create([
            'name' => 'myStoreTextUpdate',
            'label' => 'My Store Text',
            'description' => null,
            'value' => '100',
            'type' => 'testName',
        ]);

        $opt->update([
            'value' => '5000',
        ]);
        $opt->fresh();

        $this->assertSame('store:5000', $opt->value);
    }

    public function test_it_renders_edit_html()
    {
        $options = $this->getOptionsInstance();
        $options->load();

        $opt = Option::create([
            'name' => 'testHTML',
            'label' => 'My Store Text',
            'description' => null,
            'value' => 'Hello',
            'type' => 'text',
        ]);

        $this->assertStringContainsString('options[testHTML]', $opt->renderEditHTML());
    }
}
