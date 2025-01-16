<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaProcedimientoInsumo extends Model
{
    use HasFactory;

    protected $table = 'citas_procedimientos_insumos';
    protected $primaryKey = 'id_cita_procedimiento_insumo';
    public $timestamps = true;

    protected $fillable = ['id_cita', 'id_insumo_procedimiento'];

    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }

    public function insumoProcedimiento()
    {
        return $this->belongsTo(InsumoProcedimiento::class, 'id_insumo_procedimiento');
    }
}
