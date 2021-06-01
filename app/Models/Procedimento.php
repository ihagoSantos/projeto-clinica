<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimento extends Model
{
    use HasFactory;

    // tabela
    protected $table = 'procedimento';
    // atributos
    protected $fillable = ['nome','valor','atendimento_id'];

    // retorna o atendimento que possui os procedimentos
    public function atendimento() {
        return $this->belongsTo(Atendimento::class);
    }
}
