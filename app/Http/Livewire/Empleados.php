<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\Rol;
use Livewire\Component;

class Empleados extends Component
{
    public $empleadoSeleccionadoId;
    public $nombre, $apellido, $usuario, $contrasena, $estado, $rol_id;

    protected $rules = [
        'nombre' => 'required',
        'apellido' => 'required',
        'usuario' => 'required',
        'contrasena'=> 'required',
        'estado' => 'not_in:Seleccione',
        'rol_id' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'nombre.required' => 'El campo no puede estar vacio',
        'apellido.required' => 'El campo no puede estar vacio',
        'usuario.required' => 'El campo no puede estar vacio',
        'contrasena.required' => 'El campo no puede estar vacio',
        'estado.not_in' => 'Debe seleccionar un estado',
        'rol_id.not_in' => 'Debe seleccionar un rol'
    ];

    public function mount(){
        $this->estado = "Seleccione";
        $this->rol_id = "Seleccione";
    }

    public function render()
    {
        $empleados = Empleado::all();
        $rols = Rol::orderBy('rol')->get();
        return view('livewire.empleados.index', compact('empleados','rols'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->nombre=null;
        $this->apellido=null;
        $this->usuario=null;
        $this->contrasena=null;
        $this->estado= 'Seleccione';
        $this->rol_id= 'Seleccione';
        $this->empleadoSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        Empleado::create([
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "usuario" => $this->usuario,
            "contrasena" => $this->contrasena,
            "estado" => $this->estado,
            "rol_id" => $this->rol_id
        ]);
        $this->dispatchBrowserEvent('ocultarModal', []);
        $this->limpiar();
    }

    public function edit(Empleado $empleado){
        $this->nombre = $empleado->nombre;
        $this->apellido = $empleado->apellido;
        $this->usuario = $empleado->usuario;
        $this->contrasena = $empleado->contrasena;
        $this->estado = $empleado->estado;
        $this->rol_id = $empleado->rol_id;

        $this->empleadoSeleccionadoId = $empleado->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $empleado = Empleado::find($this->empleadoSeleccionadoId);
        $this->validate();
        $empleado->update([
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "usuario" => $this->usuario,
            "contrasena" => $this->contrasena,
            "estado" => $this->estado,
            "rol_id" => $this->rol_id
        ]);
        $this->dispatchBrowserEvent('ocultarModal', []);
        $this->limpiar();
    }

    public function destroy(Empleado $empleado){
        $empleado->delete();
    }
}
