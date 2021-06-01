<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AtendimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // criando seeder para atendimento
        DB::table('atendimento')->insert([
            'profissional_id' => 1,
            'paciente_id' => 1,
            'data_hora_atendimento' => '2020-06-06 10:00:00',
        ]);
    }
}
