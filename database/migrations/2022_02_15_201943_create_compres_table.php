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
            $table->date('data_compra');
            $table->date('data_entrega');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('compres');
    }
};
