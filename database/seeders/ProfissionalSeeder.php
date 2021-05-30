<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfissionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Criando seeder para profissionais
        DB::table('profissional')->insert([
            'nome' => 'Pedro Caetano',
            'especialidade' => 'Cardiologia',
            'comissao' => 0.75
        ]);
        DB::table('profissional')->insert([
            'nome' => 'Roberto Protasio',
            'especialidade' => 'Neurologia',
            'comissao' => 0.90
        ]);
    }
}
