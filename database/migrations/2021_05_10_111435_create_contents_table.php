<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('redirect')->nullable($value = true);
            $table->integer('status')->default(1);
            $table->integer('category_id')->nullable($value = true);
            $table->integer('page_id')->nullable($value = true);
            $table->integer('sort')->default(0);
            $table->json('detail')->nullable($value = true);
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
        Schema::dropIfExists('contents');
    }
}
