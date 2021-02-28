<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model {

    protected $primaryKey = 'codcliente';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'sobrenome', 'email', 'senha', 'sexo', 'dtnascimento', 'token', 'codstatus', 'capa', 'imagem', 'xcapa', 'ycapa', 'wcapa', 'hcapa'
    ];

}
