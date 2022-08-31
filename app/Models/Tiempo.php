<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiempo extends Model
{
    use HasFactory;

    /** Nombre de la tabla */
    protected $table = 'tiempos';

    /** Nombre de la primary key */
    protected $primaryKey = 'id';

    /** Habilitar id auto icrementable */
    public $incrementing = true;

    /** Deshabilitar timestamps */
    public $timestamps = false;
}
