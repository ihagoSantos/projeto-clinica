<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;
    // tabela
    protected $table = 'atendimento';
    // atributos
    protected $fillable = ['valor','profissional_id','paciente_id','data_hora_atendimento','finalizado'];

    // retorna o profissional associado ao atendimento
    public function profissional() {
        return $this->hasOne(Profissional::class, 'id');
    }

    // retorna o paciente associado ao atendimento
    public function paciente() {
        return $this->hasOne(Paciente::class, 'id');
    }
    
    // retorna os procedimentos associados ao atendimento
    public function procedimentos() {
        return $this->hasMany(Procedimento::class, 'atendimento_id','id');
    }

}
