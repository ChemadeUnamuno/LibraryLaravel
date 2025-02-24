<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestamo extends Model
{
    protected $fillable = [
        'id_socio', 'id_ejemplar', 'fecha_prestamo'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_socio');
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(EjemplarLibro::class, 'id_ejemplar');
    }
}
