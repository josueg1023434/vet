<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Mascota extends Model
{
    use HasFactory;

    protected $table = 'mascotas';
    protected $primaryKey = 'id_mascota';
    public $timestamps = true;

    protected $fillable = [
        'id_usuario',
        'nombre_mascota',
        'raza_mascota',
        'color_mascota',
        'peso_mascota',
        'fecha_mascota',
        'foto_mascota',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_mascota');
    }
    protected $casts = [
        'fecha_mascota' => 'datetime',
    ];
    
}
