<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Mascota;

class CitaController extends Controller
{
    /**
     * Muestra una lista de todas las citas.
     */
    public function index()
    {
        $citas = Cita::with('mascota')->get();
        return view('citas.index', compact('citas'));
    }

    /**
     * Muestra el formulario para crear una nueva cita.
     */
    public function create()
    {
        $mascotas = Mascota::all(); // Obtiene todas las mascotas para el dropdown
        return view('citas.create', compact('mascotas'));
    }

    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_mascota' => 'required|exists:mascotas,id',
            'fecha_hora' => 'required|date',
            'estado' => 'required|string|max:255',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada con éxito.');
    }

    /**
     * Muestra los detalles de una cita específica.
     */
    public function show($id)
    {
        $cita = Cita::with('mascota', 'procedimientosInsumos')->findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    /**
     * Muestra el formulario para editar una cita específica.
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        $mascotas = Mascota::all();
        return view('citas.edit', compact('cita', 'mascotas'));
    }

    /**
     * Actualiza una cita en la base de datos.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_mascota' => 'required|exists:mascotas,id',
            'fecha_hora' => 'required|date',
            'estado' => 'required|string|max:255',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada con éxito.');
    }

    /**
     * Elimina una cita específica.
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada con éxito.');
    }
}
