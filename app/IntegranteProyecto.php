<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntegranteProyecto extends Model
{
    protected $table = 'proyecto_has_integrante';
    public $timestamps = false;

    protected $fillable = [
        'integrante_id',
        'proyecto_id'
    ];
}
