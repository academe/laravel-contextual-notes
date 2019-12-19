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
            $table->timestamps(6);

            $table->bigInteger('note_id')->unsigned();

            // Q: Can these two be replaced by $table->morphs('noteable')?
            // A: No, because that does not use bigInteger.
            $table->bigInteger('notable_id')->unsigned();
            $table->string('notable_type');

            // Optional relationship with author (to be completed).
            $table->bigInteger('author_id')->unsigned()->nullable();

            $table->foreign('note_id')
                ->references('id')
                ->on(config('academe-contextual-notes.notes.table', 'notes'))
                ->onDelete('cascade');

            // Other indexes.
            $table->index(['notable_id', 'notable_type']);
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
