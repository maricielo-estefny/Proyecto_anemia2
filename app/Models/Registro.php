<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registro';
    protected $primaryKey = 'codigo';
    public $timestamps = false;

    protected $fillable = [
        'dni',
        'nombre_apellido',
        'edad',
        'peso',
        'altura',
        'sexo',
        'hmg',
        'RBC',
        'MCH',
        'TLC',
        'PLT',
        'MCHC',
        'RDW',
        'PCV',
        'MCV',
        'fecha',
        'hora',
        'tipo_prediccion',
        'resultado',
    ];

    //USER O DOCTOR, cambian el valor

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }
}
