<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // criando seeder para paciente
        DB::table('paciente')->insert([
            'nome' => 'Ihago Santos'
        ]);

    }
}
