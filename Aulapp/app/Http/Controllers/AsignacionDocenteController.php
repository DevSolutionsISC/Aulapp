<?php

namespace App\Http\Controllers;

use App\Models\asignacionDocentes;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{
    public function busqueda(Request $request)
    {

        $asignacionDocente = asignacionDocentes::query();

        if ($request->has('search')) {
            $asignacionDocente->where('id', 'like', $request->search);
        }
        $asignacionDocentes = $asignacionDocente->get();
        return view('eliminar_asignacion_docente', compact('asignacionDocentes'));

    }
    public function destroy($asignacionDocente)
    {
        $asignacionDocente = asignacionDocentes::find($asignacionDocente);
        $asignacionDocente->grupos()->each(function ($grupo) {
            $grupo->delete(); // <-- direct deletion
        });
        $asignacionDocente->delete();

        return redirect()->route('eliminar-asignacion-docente')->with('eliminar', 'ok');
    }
}