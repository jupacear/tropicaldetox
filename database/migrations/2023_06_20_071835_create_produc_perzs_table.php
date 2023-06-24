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
        Schema::create('produc_perzs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pedidos');
            $table->foreign('id_pedidos')->references('id')->on('pedidos');

            $table->unsignedBigInteger('insumos');
            $table->foreign('insumos')->references('id')->on('pedidos');

            $table->integer('cantidad');
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
        Schema::dropIfExists('produc_perzs');
    }
};
