<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeccion;
use App\Models\Aula;
use App\Models\AulaAsignada;
use App\Models\reserva;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SectionsController extends Controller
{
    public function index()
    {
        return view('Seccion.registrar_seccion_de_aula');
    }

    public function showEdit()
    {
        $secciones = Section::all();
        return view('Seccion.editarseccion', ['secciones' => $secciones]);

    }
    public function reporte()
    {
        $sections = Section::all();
        return view('Seccion.reporte_seccion', compact('sections'));
    }

    public function store(StoreSeccion $request)
    {

        $seccion = new Section();
        $seccion->nombre = $request->nombre;
        $seccion->descripcion = $request->descripcion;
        $seccion->save();

        return redirect()->route('secciones')->with('registrar', 'ok');
    }

    public function show($id)
    {

    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);
        $request->validate([
            'nombre' => 'required|min:10|max:50|regex:/^[a-zA-Z\s áéíóúÁÉÍÓÚñÑ 0-9]+$/u|unique:sections,nombre,' . $section->id,
            'descripcion' => 'required|min:10|max:50',
        ]);

        $section->nombre = $request->nombre;
        $section->descripcion = $request->descripcion;
        $section->estado = $request->estadoE;
        $section->save();
        return redirect()->route('seccion_edit')->with('actualizar', 'ok');

    }
    public function busqueda(Request $request)
    {
        $nombre = $request->search;
        try {

            $section = Section::query();

            if ($request->has('search')) {
                $section->where('nombre', 'like', $request->search);

            }
            $sections = $section->get();
            return view('Seccion.eliminar_seccion', compact('sections'));

        } catch (\Throwable $th) {

            return redirect()->route('eliminar-seccion')->with('buscar', 'error');

        }}

    public function estado(Request $request, $section)
    {
        $section = Section::find($section);
        $aulas_asignadas = AulaAsignada::all();
        $aulas = Aula::all();
        $reservas = reserva::all();
        $fecha = Carbon::now();
        $ocupado = false;

        foreach ($aulas_asignadas as $aula_asignada) {
            foreach ($aulas as $aula) {
                if ($aula_asignada->aula_id == $aula->id && $section->id == $aula->section_id) {
                    foreach ($reservas as $reserva) {
                        if ($reserva->id == $aula_asignada->reserva_id && $reserva->fecha_examen >= $fecha->toDateString() && $reserva->estado == 'aceptado' && ($fecha->toTimeString() < $reserva->hora_inicio || $reserva->hora_fin > $fecha->toTimeString())) {
                            $ocupado = true;

                        }

                    }

                }
            }
        }

        if ($ocupado == true) {
            return redirect()->route('eliminar-seccion')->with('eliminar', 'error');
        } else if ($ocupado == false) {
            $section->where('id', $request->section)->update(['estado' => false]);

            $section->aulas()->each(function ($aula) {
                $aula->where('id', $aula->id)->update(['estado' => false]);
            });

            return redirect()->route('eliminar-seccion')->with('eliminar', 'ok');

        }

    }

}