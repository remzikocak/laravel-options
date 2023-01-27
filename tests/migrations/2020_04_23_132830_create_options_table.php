<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('label');
            $table->string('description', 500)->nullable()->default(null);
            $table->string('type');
            $table->text('value');
            $table->timestamps();
        });

        Schema::create('option_optiongroup', function (Blueprint $table) {
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('optiongroup_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('option_optiongroup');
    }
}
