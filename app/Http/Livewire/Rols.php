<?php

namespace App\Http\Livewire;

use App\Models\Rol;
use Livewire\Component;

class Rols extends Component
{
    public $rolSeleccionadoId;
    public $rol;

    protected $rules = [
        'rol' => 'required'
    ];

    protected $messages = [
        'rol.required' => 'El campo no puede estar vacio'
    ];

    public function render()
    {
        $rols = Rol::all();
        return view('livewire.rols.index', compact('rols'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->rol=null;
        $this->rolSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        try {
            Rol::create([
                "rol" => $this->rol
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Rol $rol){
        $this->rol = $rol->rol;

        $this->rolSeleccionadoId = $rol->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $rol = Rol::find($this->rolSeleccionadoId);
        $this->validate();
        try {
            $rol->update([
                "rol" => $this->rol
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Rol $rol){
        try {
            $rol->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
