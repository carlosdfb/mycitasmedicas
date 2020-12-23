<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\specialty;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class SpecialtyController extends Controller
{



    private function performValidation(REquest $request){
        $rules = [
            'name' => 'required|min:3',
            'descripcion' => 'required',
        ];
        $messages = [
            'name.required' => "No puede estar el campo nombre vacio",
            'descripcion.required' => "No puede estar el campo descripción vacio",
            'name.min' => "Parece ser muy corto el nombre...",
        ];
        $this->validate($request, $rules, $messages);
    }


    public function index()
    {
        $specialties = specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function store(Request $request)
    {
        $this->performValidation($request);
        //dd($request->all()); // para ver que contiene el objeto request
        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->descripcion = $request->input('descripcion');
        $specialty->save();
        $notification = "La especialidad se ha registrado satisfactoriamente";
        return redirect('/specialties')->with(compact('notification'));


    }

    public function edit(specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, specialty $specialty)
    {
        $this->performValidation($request);
        //dd($request->all()); // para ver que contiene el objeto request
        $specialty->name = $request->input('name');
        $specialty->descripcion = $request->input('descripcion');
        $specialty->save(); // update
        $notification = "La especialidad se ha actualizado satisfactoriamente";
        return redirect('/specialties')->with(compact('notification'));


    }

    public function destroy(specialty $specialty)
    {
        $specialtyname = $specialty->name;
        $specialty->delete();
        $notification = 'La especialidad ' . $specialtyname .' se ha eliminado satisfactoriamente';
        return redirect('/specialties')->with(compact('notification'));


    }

}
