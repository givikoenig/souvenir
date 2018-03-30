<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeBlockPageTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_page', function (Blueprint $table) {
            //
            $table->integer('block_id')->unsigned()->default(1);
            $table->foreign('block_id')->references('id')->on('blocks');
            
            $table->integer('page_id')->unsigned()->default(1);
            $table->foreign('page_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_page', function (Blueprint $table) {
            //
        });
    }
}
