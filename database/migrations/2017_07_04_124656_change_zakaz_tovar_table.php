<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeZakazTovarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zakaz_tovar', function (Blueprint $table) {
            //
            $table->unsignedTinyInteger('quantity');
            $table->integer('order_id')->unsigned()->default(0);
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zakaz_tovar', function (Blueprint $table) {
            //
        });
    }
}
