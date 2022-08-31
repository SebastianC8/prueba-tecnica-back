<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    /** Nombre de la tabla */
    protected $table = 'actividades';

    /** Nombre de la primary key */
    protected $primaryKey = 'id';

    /** Habilitar id auto icrementable */
    public $incrementing = true;

    /** Deshabilitar timestamps */
    public $timestamps = false;
}
