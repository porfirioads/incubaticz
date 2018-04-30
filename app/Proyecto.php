<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyecto';
    public $timestamps = false;

    protected $fillable = [
        'titulo',
        'anteproyecto',
        'descripcion',
        'impacto',
        'factibilidad',
        'cronograma',
        'metodologia',
        'resultados',
        'plan_negocios'
    ];
}
