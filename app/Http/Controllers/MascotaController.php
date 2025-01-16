<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    /**
     * Display a listing of the mascotas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mascotas = Mascota::with('User')->paginate(10);
        return view('mascotas.index', compact('mascotas'));
    }

    /**
     * Show the form for creating a new mascota.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $usuarios = User::all();
        return view('mascotas.create', compact('usuarios'));
    }

    /**
     * Store a newly created mascota in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_usuario' => 'required|exists:users,id_usuario',
            'nombre_mascota' => 'required|string|max:255',
            'raza_mascota' => 'nullable|string|max:255',
            'color_mascota' => 'nullable|string|max:255',
            'peso_mascota' => 'nullable|numeric|min:0',
            'fecha_mascota' => 'nullable|date',
            'foto_mascota' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_mascota')) {
            $data['foto_mascota'] = $request->file('foto_mascota')->store('fotos_mascotas', 'public');
        }        

        Mascota::create($data);

        return redirect()->route('mascotas.index')->with('success', 'Mascota creada exitosamente.');
    }

    /**
     * Show the form for editing the specified mascota.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $mascota = Mascota::findOrFail($id);
        $usuarios = User::all();

        return view('mascotas.edit', compact('mascota', 'usuarios'));
    }

    /**
     * Update the specified mascota in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $mascota = Mascota::findOrFail($id);

        $request->validate([
            'id_usuario' => 'required|exists:users,id_usuario',
            'nombre_mascota' => 'required|string|max:255',
            'raza_mascota' => 'nullable|string|max:255',
            'color_mascota' => 'nullable|string|max:255',
            'peso_mascota' => 'nullable|numeric|min:0',
            'fecha_mascota' => 'nullable|date',
            'foto_mascota' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_mascota')) {
            if ($mascota->foto_mascota) {
                Storage::disk('public')->delete($mascota->foto_mascota);
            }
            $data['foto_mascota'] = $request->file('foto_mascota')->store('fotos_mascotas', 'public');
        }        
        $data['fecha_mascota'] = $request->fecha_mascota ?: null;

        $mascota->update($data);

        return redirect()->route('mascotas.index')->with('success', 'Mascota actualizada exitosamente.');
    }

    /**
     * Remove the specified mascota from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $mascota = Mascota::findOrFail($id);

        if ($mascota->foto) {
            Storage::disk('public')->delete($mascota->foto);
        }

        $mascota->delete();

        return redirect()->route('mascotas.index')->with('success', 'Mascota eliminada exitosamente.');
    }
}