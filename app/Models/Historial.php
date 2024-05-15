<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Historial extends Model
{
    protected $table = 'historial';
    protected $primaryKey = 'id'; 
    public $timestamps = false;
    
    public static function obtenerAulas()
    {
        return Historial::pluck('nombre', 'id');
    }
    use HasFactory;
}