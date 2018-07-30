<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecentWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recent_works', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('url')->nullable();
            $table->text('description')->nullable();
            $table->text('alt')->nullable();
            $table->string('image');
            $table->boolean('active')->nullable();
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
        Schema::dropIfExists('recent_works');
    }
}
