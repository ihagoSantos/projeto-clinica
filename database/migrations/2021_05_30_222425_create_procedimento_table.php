<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedimento', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->float('valor');

            // FK atendimento
            $table->unsignedBigInteger('atendimento_id');
            $table->foreign('atendimento_id')->references('id')->on('atendimento');
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
        Schema::dropIfExists('procedimento');
    }
}
