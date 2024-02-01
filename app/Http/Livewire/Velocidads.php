<?php

namespace App\Http\Livewire;

use App\Models\Velocidad;
use Livewire\Component;

class Velocidads extends Component
{
    public $velocidadSeleccionadoId;
    public $cantVelocidad;

    protected $rules = [
        'cantVelocidad' => 'required'
    ];

    protected $messages = [
        'cantVelocidad.required' => 'El campo no puede estar vacio'
    ];

    public function render()
    {
        $velocidads = Velocidad::all();
        return view('livewire.velocidads.index', compact('velocidads'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->cantVelocidad=null;
        $this->velocidadSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        try {
            Velocidad::create([
                "cantVelocidad" => $this->cantVelocidad
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Velocidad $velocidad){
        $this->cantVelocidad = $velocidad->cantVelocidad;

        $this->velocidadSeleccionadoId = $velocidad->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $velocidad = Velocidad::find($this->velocidadSeleccionadoId);
        $this->validate();
        try {
            $velocidad->update([
                "cantVelocidad" => $this->cantVelocidad
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(velocidad $velocidad){
        try {
            $velocidad->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
