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
        Schema::create('productes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('descripcio');
            $table->string('imatge');
            $table->integer('preu');
            $table->integer('descompte');
            $table->integer('stock');

            $table->string('proveidor');
            $table->foreign('proveidor')
                    ->references('nom')
                    ->on('proveidors')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->string('categoria');
            $table->foreign('categoria')
                    ->references('nom')
                    ->on('categories')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

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
        Schema::dropIfExists('productes');
    }
};
