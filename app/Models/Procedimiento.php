<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;

    protected $table = 'procedimientos';
    protected $primaryKey = 'id_procedimiento';
    public $timestamps = true;

    protected $fillable = ['tipo_procedimiento', 'detalle', 'valor'];

    public function insumos()
    {
        return $this->belongsToMany(Insumo::class, 'insumos_procedimientos', 'id_procedimiento', 'id_insumo');
    }
}
