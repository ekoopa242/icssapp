<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use App\Models\Velocidad;
use Livewire\Component;

class Plans extends Component
{
    public $planSeleccionadoId;
    public $nombrePlan, $precio, $velocidad_id;

    protected $rules = [
        'nombrePlan' => 'not_in:Seleccione',
        'precio' => 'numeric',
        'velocidad_id' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'nombrePlan.not_in' => 'Debe seleccionar un plan',
        'nombrePlan.min' => 'El campo debe tenot_in:Seleccione caracteres',
        'precio.numeric' => 'El campo de ser numerico',
        'velocidad_id.not_in' => 'Debe seleccionar una cantidad de velocidad'
    ];

    public function mount(){
        $this->nombrePlan = "Seleccione";
        $this->velocidad_id = "Seleccione";
    }

    public function render()
    {
        $plans = Plan::all();
        $velocidads = Velocidad::orderBy('cantVelocidad')->get();
        return view('livewire.plans.index', compact('plans','velocidads'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->nombrePlan= 'Seleccione';
        $this->precio=null;
        $this->velocidad_id= 'Seleccione';
        $this->planSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        try {
            Plan::create([
                "nombrePlan" => $this->nombrePlan,
                "precio" => $this->precio,
                "velocidad_id" => $this->velocidad_id
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Plan $plan){
        $this->nombrePlan = $plan->nombrePlan;
        $this->precio = $plan->precio;
        $this->velocidad_id = $plan->velocidad_id;

        $this->planSeleccionadoId = $plan->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $plan = Plan::find($this->planSeleccionadoId);
        $this->validate();
        try {
            $plan->update([
                "nombrePlan" => $this->nombrePlan,
                "precio" => $this->precio,
                "velocidad_id" => $this->velocidad_id
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Plan $plan){
        try {
            $plan->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
