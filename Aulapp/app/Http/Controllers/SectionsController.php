<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeccion;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function index()
    {
        return view('registrar_seccion_de_aula');
    }

    public function showEdit()
    {
        $secciones = Section::all();
        return view('editarseccion', ['secciones' => $secciones]);

    }
    public function reporte()
    {
        $sections = Section::all();
        return view('reporte_seccion', compact('sections'));
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
            'nombre' => 'required|min:3|max:50|regex:/^[a-zA-Z-ñÑ\s]+$/u|unique:sections,nombre,' . $section->id,
            'descripcion' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9-ñÑ\s]+$/u',
        ]);

        $section->nombre = $request->nombre;
        $section->descripcion = $request->descripcion;
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

    public function destroy($section)
    {
        $section = Section::find($section);
        $newSection = $section->replicate();
        $newSection->setTable('log_secciones');
        $newSection->save();

        $section->aulas()->each(function ($aula) {
            $aula->delete(); // <-- direct deletion
        });
        $section->delete();

        return redirect()->route('eliminar-seccion')->with('eliminar', 'ok');
    }

}