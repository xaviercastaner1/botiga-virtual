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

            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                    ->references('id')
                    ->on('clients')
                    ->onDelete('cascade');

            $table->unsignedBigInteger('id_producte');
            $table->foreign('id_producte')
                    ->references('id')
                    ->on('productes')
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
