<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'departamentos';
    protected $primaryKey = 'id'; 
    public $timestamps = false;

    public static function obtenerDepartamentos()
    {
        return Departamento::pluck('nombre', 'id');
    }
}