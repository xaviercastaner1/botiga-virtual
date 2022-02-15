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

            $table->integer('id_proveidor');
            $table->foreignId('id_proveidor')
                    ->constrained('proveidors')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('id_categoria');
            $table->foreignId('id_categoria')
                    ->constrained('categories')
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
