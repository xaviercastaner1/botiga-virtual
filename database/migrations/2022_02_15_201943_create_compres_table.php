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
            $table->date('data_compra')->nullable();
            $table->date('data_entrega')->nullable();

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->json('productes');

            $table->boolean('validat');

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
