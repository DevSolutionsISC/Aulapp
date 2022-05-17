<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAsignacion;
use App\Models\asignacionDocentes;
use App\Models\Materia;
use App\Models\Materia_Carrera;
use App\Models\UserRol;
use Illuminate\Http\Request;

class AsignacionDocenteController extends Controller
{

    public function registro()
    {
        $materias = Materia_Carrera::where('estado', true)->get();
        $docentes = UserRol::all();
        $docente_materias = asignacionDocentes::all();
        return view('Asignacion-Docente.registro_asignacion_docente', ['materias' => $materias, 'docentes' => $docentes, 'docente_materias' => $docente_materias]);
    }

    public function store(StoreAsignacion $request)
    {
        $asignacion_docente = new asignacionDocentes();
        $asignacion_docente->user_rol_id = $request->docente;
        $asignacion_docente->materia_carreras_id = $request->materia;
        $asignacion_docente->save();

        return redirect()->route('materia_docente')->with('registrar', 'ok');

    }

    public function busqueda(Request $request)
    {

        try {
            $asignacionDocente = asignacionDocentes::query();

            if ($request->has('search')) {
                $asignacionDocente->where('id', 'like', $request->search);
            }
            $asignacionDocentes = $asignacionDocente->get();
            return view('Asignacion-Docente.eliminar_asignacion_docente', compact('asignacionDocentes'));

        } catch (\Throwable $th) {
            return redirect()->route('eliminar-asignacion-docente')->with('buscar', 'error');

        }

    }
    public function reporte()
    {

        $asignacionDocentes = asignacionDocentes::all();
        return view('Asignacion-Docente.reporte_asignacion_docente', compact('asignacionDocentes'));

    }
    public function estado($asignacion_docente)
    {
        $asignacion_docente = asignacionDocentes::find($asignacion_docente);
        $asignacion_docente->estado = false;
        $asignacion_docente->save();

        //$asignacion_docente->where('id', $asignacion_docente->id)->update(['estado' => false]);

        return redirect()->route('eliminar-asignacion-docente')->with('eliminar', 'ok');
    }
}