<?php

namespace Desafio;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nome'];

    public function herois()
    {
      return $this->hasMany('Desafio\Heroi');
    }
}
