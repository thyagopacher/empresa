<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dim_telas extends Model {

    protected $primaryKey = 'id_tela';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'desc_tela'
    ];

}
