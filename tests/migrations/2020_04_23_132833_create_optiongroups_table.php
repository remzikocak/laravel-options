<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptiongroupsTable extends Migration
{
    public function up()
    {
        Schema::create('optiongroups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->string('description', 500)->nullable()->default(null);
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('optiongroups');
    }
}
