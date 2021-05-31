<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profissional extends Model
{
    use HasFactory;
    // nome da tabela
    protected $table = 'profissional';
    // atributos
    protected $fillable = ['nome', 'especialidade', 'comissao'];

    // retorna o atendimento que possui o profissional
    public function atendimento() {
        return $this->belongsTo(Atendimento::class, 'profissional_id');
    }
}
