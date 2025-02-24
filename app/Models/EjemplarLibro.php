<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EjemplarLibro extends Model
{

    use HasFactory;

    protected $table = 'ejemplar_libros';
    protected $primaryKey = 'id_ejemplar';

    protected $fillable = [
        'titulo', 'autor', 'editorial'
    ];

    public function loans()
    {
        return $this->hasMany(Prestamo::class, 'id_ejemplar');
    }
}
