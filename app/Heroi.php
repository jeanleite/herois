<?php

namespace Desafio;

use Illuminate\Database\Eloquent\Model;

class Heroi extends Model
{
  protected $fillable = ['nome', 'vida', 'dano', 'defesa', 'velocidade_ataque', 'velocidade_movimento', 'classe_id'];

  public function especialidades()
  {
    return $this->belongsToMany('Desafio\Especialidade', 'heroi_especialidades', 'heroi_id', 'especialidade_id');
  }

  public function classe(){
    return $this->belongsTo('Desafio\Classe');
  }
}
