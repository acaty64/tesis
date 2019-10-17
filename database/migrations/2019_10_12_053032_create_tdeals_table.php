<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTdealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tdeals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 35);
            $table->boolean('blade')->default(false);
            $table->boolean('email')->default(false);
            $table->boolean('upload')->default(false);
            $table->boolean('download')->default(false);
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
        Schema::dropIfExists('tdeals');
    }
}
