<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FKAddSiloContentsToSilos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('silo_contents', function (Blueprint $table) {
            // weird mysql logic
            $table->engine = 'InnoDB';
            // *****************
            $table->integer('silo_id')->unsigned();
            $table->foreign('silo_id')->references('id')->on('silos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('silo_contents', function (Blueprint $table) {
            $table->dropForeign('silo_contents_silo_id_foreign');
        });
    }
}
