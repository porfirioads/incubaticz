<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectoHasIntegrante extends Model
{
    protected $table = 'proyecto_has_integrante';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'proyecto_id',
        'integrante_id',
    ];
}
