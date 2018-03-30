<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpcommingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upcommings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('img_362x350')->nullable();
            $table->string('img_370x350')->nullable();
            $table->string('title1')->nullable();
            $table->text('text1')->nullable();
            $table->string('title2')->nullable();
            $table->text('text2')->nullable();
            $table->float('price', 8, 2);
            $table->timestamp('until_date');
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
        Schema::dropIfExists('upcommings');
    }
}
