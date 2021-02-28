<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    
    protected $primaryKey = 'codfornecedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'razao', 'email', 'senha', 'token', 'codstatus', 'tipo', 'abacode', 'xcapa', 'ycapa', 'wcapa', 'hcapa'
    ];

}
