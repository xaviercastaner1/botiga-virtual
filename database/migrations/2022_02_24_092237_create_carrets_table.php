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
        Schema::create('carrets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table->json('productes');
            
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
        Schema::dropIfExists('carrets');
    }
};
