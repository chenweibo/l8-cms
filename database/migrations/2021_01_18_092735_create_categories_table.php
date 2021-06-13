<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('type', 20);
            $table->string('url');
            $table->json('detail')->nullable($value = true);
            $table->string('redirect')->nullable($value = true);
            $table->string('columnTemplate')->nullable($value = true);
            $table->string('contentTemplate')->nullable($value = true);
            $table->integer('sort')->default(0);
            $table->integer('status')->default(1);
            $table->integer('page')->default(10);
            $table->string('controller')->nullable($value = true);
            $table->string('function')->nullable($value = true);
            $table->nestedSet();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
