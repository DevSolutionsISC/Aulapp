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
            'nombre' => 'required|min:3|max:50|unique:sections|regex:/^[a-zA-Z\s]+$/u',
            'descripcion' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9\s]+$/u',
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
            'nombre' => 'required|min:3|max:50|unique:sections|regex:/^[a-zA-Z\s]+$/u',
            'descripcion' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9\s]+$/u',
        ]);

        $section = Section::find($id);
        $section->nombre = $request->nombre;
        $section->descripcion = $request->descripcion;
        $section->save();
        return redirect()->route('secciones')->with('actualizar', 'ok');

    }
    public function destroy($id)
    {
        $section = Section::find($id);
        $section->delete();
        return redirect()->route('secciones')->with('eliminar', 'ok');
    }

}