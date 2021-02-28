<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localizacao extends Model {

    protected $primaryKey = 'codlocalizacao';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'longitude', 'latitude', 'codcliente', 'enderecoip'
    ];

}
