<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {

            // 1. creo la colonna della FK
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

            // 2. assegno la FK alla colonna creata
            $table->foreign('type_id')
                ->references('id')
                ->on('types')
                ->onDelete('set null'); //quando elimino un type il type_id del project diventa null

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {

            // 1. elimino la FK
            $table->dropForeign(['type_id']);

            // 2. drop della colonna
            $table->dropColumn('type_id');
        });
    }
};
