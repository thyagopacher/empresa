<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ftp_Logs extends Model
{
    
    protected $primaryKey = 'codcliente';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'razao', 'email', 'senha', 'token', 'codstatus', 'tipo', 'abacode', 'xcapa', 'ycapa', 'wcapa', 'hcapa'
    ];
}
