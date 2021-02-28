<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusConta extends Model {

    protected $table = 'statusconta';
    protected $primaryKey = 'codstatus';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'codigo'
    ];

    
}
