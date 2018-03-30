<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->unsignedInteger('subbrand_id');
            $table->string('articul')->nullable();
            $table->string('images')->nullable();
            $table->string('img_slide')->nullable();
            $table->float('price');
            $table->float('old_price');
            $table->string('anons')->nullable();
            $table->string('content')->nullable();
            $table->enum('visible', ['0', '1']);
            $table->enum('available', ['0', '1']);
            $table->enum('hits', ['0', '1']);
            $table->enum('new', ['0', '1']);
            $table->enum('sale', ['0', '1']);
            $table->enum('wish', ['0', '1']);
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
        Schema::dropIfExists('products');
    }
}
