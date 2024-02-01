<?php

namespace App\Http\Livewire;

use App\Models\Equipo;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;

class Equipos extends Component
{
    public $search = '';
    public $equipoSeleccionadoId;
    public $modelo, $mac, $tipoEquipo, $estado, $iniciorangofecha, $finalrangofecha;

    protected $rules = [
        'modelo' => 'required|min:4',
        'mac' => 'required|max:12',
        'tipoEquipo' => 'not_in:Seleccione',
        'estado' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'modelo.required' => 'El campo no puede estar vacio',
        'modelo.min' => 'El campo debe tener al menos 4 caracteres',
        'mac.required' => 'El campo no puede estar vacio',
        'mac.max' => 'La mac es de 12 caracteres',
        'tipoEquipo.not_in' => 'Debe seleccionar un estado',
        'estado.not_in' => 'Debe seleccionar un estado',
    ];

    public function mount(){
        $this->tipoEquipo = "Seleccione";
        $this->estado = "Seleccione";
    }

    public function render()
    {
        $equipos= Equipo::query();

        if(strlen($this->search)>2){
            $equipos = $equipos->where(function($q){
                $q->where('mac', 'like', "%" . $this->search . "%")
                    ->orWhere('modelo', 'like', "%" . $this->search . "%");
            });
        }

        if($this->iniciorangofecha!=null && $this->finalrangofecha!=null){
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $equipos = $equipos->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $equipos = $equipos->get();
        return view('livewire.equipos.index', compact('equipos'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->modelo=null;
        $this->mac=null;
        $this->tipoEquipo= 'Seleccione';
        $this->estado= 'Seleccione';
        $this->equipoSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        try {
            Equipo::create([
                "modelo" => $this->modelo,
                "mac" => $this->mac,
                "tipoEquipo" => $this->tipoEquipo,
                "estado" => $this->estado
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Equipo $equipo){
        $this->modelo = $equipo->modelo;
        $this->mac = $equipo->mac;
        $this->tipoEquipo = $equipo->tipoEquipo;
        $this->estado = $equipo->estado;

        $this->equipoSeleccionadoId = $equipo->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $equipo = Equipo::find($this->equipoSeleccionadoId);
        $this->validate();
        try {
            $equipo->update([
                "modelo" => $this->modelo,
                "mac" => $this->mac,
                "tipoEquipo" => $this->tipoEquipo,
                "estado" => $this->estado
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Equipo $equipo){
        try {
            $equipo->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function pdf(){
        $equipos= Equipo::query();

        if(strlen($this->search)>2){
            $equipos = $equipos->where(function($q){
                $q->where('mac', 'like', "%" . $this->search . "%")
                    ->orWhere('modelo', 'like', "%" . $this->search . "%");
            });
        }

        if($this->iniciorangofecha!=null && $this->finalrangofecha!=null){
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $equipos = $equipos->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $equipos = $equipos->get();


        $pdf = Pdf::loadView('livewire.equipos.pdf', compact('equipos'))->setPaper('letter','')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'export_protocol.pdf');

    }
}
