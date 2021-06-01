<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcedimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // criando seeder para procedimento
        DB::table('procedimento')->insert([
            'nome' => 'Teste 1',
            'valor' => 150.0,
            'atendimento_id' => 1
        ]);
        DB::table('procedimento')->insert([
            'nome' => 'Teste 2',
            'valor' => 350.0,
            'atendimento_id' => 1
        ]);
    }
}
