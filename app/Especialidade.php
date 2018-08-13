<?php

namespace Desafio;

use Illuminate\Database\Eloquent\Model;

class Especialidade extends Model
{
    protected $fillable = ['nome'];

    public function herois()
    {
      return $this->belongsToMany('Desafio\Heroi', 'heroi_especialidades', 'especialidade_id', 'heroi_id');
    }

}
