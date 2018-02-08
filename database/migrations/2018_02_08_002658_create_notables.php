<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = config('academe-contextual-notes.notables.table', 'notables');

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->bigInteger('note_id')->unsigned();
            $table->bigInteger('notable_id')->unsigned();
            $table->string('notable_type', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = config('academe-contextual-notes.notables.table', 'notables');

        Schema::dropIfExists($tableName);
    }
}
