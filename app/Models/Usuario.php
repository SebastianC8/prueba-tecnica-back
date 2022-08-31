<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    /** Nombre de la tabla */
    protected $table = 'usuarios';

    /** Nombre de la primary key */
    protected $primaryKey = 'id';

    /** Deshabilitar id auto icrementable */
    public $incrementing = false;

    /** Deshabilitar timestamps */
    public $timestamps = false;
}
