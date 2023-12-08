<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario'; // Nombre de la tabla en la base de datos
    protected $primaryKey = 'IDUsuario'; // Asegúrate de que el nombre de la clave primaria sea correcto
    public $timestamps = false;
    use HasFactory;
}

