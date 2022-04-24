<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('adm_secciones', compact('sections'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:50|unique:sections|regex:/^[a-zA-Z-ñÑ\s]+$/u',
            'descripcion' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9-ñÑ\s]+$/u',
        ]);

        $seccion = new Section();
        $seccion->nombre = $request->nombre;
        $seccion->descripcion = $request->descripcion;
        $seccion->save();

        return redirect()->route('secciones')->with('registrar', 'ok');
    }

    public function show($id)
    {

        $section = Section::find($id);
        return view('adm_secciones-show', ['section' => $section]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:50|regex:/^[a-zA-Z-ñÑ\s]+$/u',
            'descripcion' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9-ñÑ\s]+$/u',
        ]);

        $section = Section::find($id);
        $section->nombre = $request->nombre;
        $section->descripcion = $request->descripcion;
        $section->save();
        return redirect()->route('secciones')->with('actualizar', 'ok');

    }
    public function busqueda(Request $request)
    {

        $section = Section::query();

        if ($request->has('search')) {
            $section->where('nombre', 'like', $request->search);
        }
        $sections = $section->get();
        return view('eliminar_seccion', compact('sections'));

    }
    public function destroy($section)
    {
        $section = Section::find($section);
        $section->aulas()->each(function ($aula) {
            $aula->delete(); // <-- direct deletion
        });
        $section->delete();

        return redirect()->route('secciones')->with('eliminar', 'ok');
    }

}