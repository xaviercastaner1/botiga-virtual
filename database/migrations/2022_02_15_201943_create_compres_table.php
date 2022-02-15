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
        Schema::create('compres', function (Blueprint $table) {
            $table->id();
            $table->integer('unitats');
            $table->date('data_compra');
            $table->date('data_entrega');

            $table->integer('id_client');
            $table->foreignId('id_client')
                    ->constrained('clients')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('id_producte');
            $table->foreign('id_producte')
                    ->constrained('productes')
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
        Schema::dropIfExists('compres');
    }
};
