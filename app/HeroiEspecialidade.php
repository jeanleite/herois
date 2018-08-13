<?php

namespace Desafio;

use Illuminate\Database\Eloquent\Model;

class HeroiEspecialidade extends Model
{
    //

    public function heroi(){
      return $this->belongsTo('Desafio\Heroi');
    }
    public function especialidade(){
      return $this->belongsTo('Desafio\Especialidade');
    }
}
