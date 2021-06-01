<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    // nome da tabela
    protected $table = 'paciente';
    // atributo
    protected $fillable = ['nome'];

    // retorna o atendimento que possui o paciente
    public function atendimento() {
        return $this->belongsTo(Atendimento::class, 'paciente_id');
    }
}
