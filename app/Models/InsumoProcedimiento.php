<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsumoProcedimiento extends Model
{
    use HasFactory;

    protected $table = 'insumos_procedimientos';
    protected $primaryKey = 'id_insumo_procedimiento';
    public $timestamps = true;

    protected $fillable = ['id_procedimiento', 'id_insumo'];

    public function procedimiento()
    {
        return $this->belongsTo(Procedimiento::class, 'id_procedimiento');
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class, 'id_insumo');
    }
}
