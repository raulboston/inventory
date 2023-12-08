<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articulo extends Model
{
    protected $table = 'articulos';
    protected $primaryKey = 'id'; 
    public $timestamps = false;

    use HasFactory;
}