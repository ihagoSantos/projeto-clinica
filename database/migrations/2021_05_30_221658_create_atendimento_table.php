<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atendimento', function (Blueprint $table) {
            $table->id();
            // valor do atendimento
            $table->float('valor')->default(0)->nulabble();
            // FK profissional
            $table->unsignedBigInteger('profissional_id');
            $table->foreign('profissional_id')->references('id')->on('profissional');
            // FK paciente
            $table->unsignedBigInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('paciente');

            // data e hora do atendimento
            $table->timestamp('data_hora_atendimento');

            // boolean que indica quando o atendimento foi finalizado
            $table->boolean('finalizado')->default(0);
            
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
        Schema::dropIfExists('atendimento');
    }
}
