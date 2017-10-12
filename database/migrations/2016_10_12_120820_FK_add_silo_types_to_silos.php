<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FKAddSiloTypesToSilos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('silo_types', function (Blueprint $table) {
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
        Schema::table('silo_types', function (Blueprint $table) {
            $table->dropForeign('silo_types_silo_id_foreign');
        });
    }
}
