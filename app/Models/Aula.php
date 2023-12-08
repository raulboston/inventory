<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $table = 'aulas';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    
    public static function obtenerAulas()
    {
        return Aula::pluck('nombre', 'id');
    }
}
