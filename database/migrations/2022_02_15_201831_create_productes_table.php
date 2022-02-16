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
            $table->string('name');
            $table->string('descripcio');
            $table->integer('preu');
            $table->integer('descompte');
            $table->integer('stock');

            $table->unsignedBigInteger('id_proveidor');
            $table->foreign('id_proveidor')
                    ->references('id')
                    ->on('proveidors')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('id_categoria');
            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('categories')
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
