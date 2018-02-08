<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = config('academe-contextual-notes.notes.table', 'notes');

        Schema::create($tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            // Just a simple message for now.
            $table->string('message', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = config('academe-contextual-notes.notes.table', 'notes');

        Schema::dropIfExists($tableName);
    }
}
