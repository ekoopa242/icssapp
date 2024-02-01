<?php

namespace App\Http\Livewire;

use App\Models\Codigocliente;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Codigoclientes extends Component
{
    public $search = '';
    public $codigoclienteSeleccionadoId;
    public $codigoCliente, $lugar, $estado, $iniciorangofecha, $finalrangofecha;

    protected $rules = [
        'codigoCliente' => 'numeric|min:4',
        'lugar' => 'not_in:Seleccione',
        'estado' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'codigoCliente.numeric' => 'El campo de ser numerico',
        'codigoCliente.min' => 'El campo debe tener al menos 4 caracteres',
        'lugar.not_in' => 'Debe seleccionar un lugar',
        'estado.not_in' => 'Debe seleccionar un estado',
    ];

    public function mount(){
        $this->lugar = "Seleccione";
        $this->estado = "Seleccione";
    }

    public function render()
    {
        $codigoclientes= Codigocliente::query();

        if(strlen($this->search)>2){
            $codigoclientes = $codigoclientes->where(function($q){
                $q->where('codigoCliente', 'like', "%" . $this->search . "%")
                    ->orWhere('lugar', 'like', "%" . $this->search . "%");
            });
        }

        if($this->iniciorangofecha!=null && $this->finalrangofecha!=null){
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $codigoclientes = $codigoclientes->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $codigoclientes = $codigoclientes->get();

        return view('livewire.codigoclientes.index', compact('codigoclientes'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->codigoCliente=null;
        $this->lugar= 'Seleccione';
        $this->estado= 'Seleccione';
        $this->codigoclienteSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store(){
        $this->validate();
        try {
            Codigocliente::create([
                "codigoCliente" => $this->codigoCliente,
                "lugar" => $this->lugar,
                "estado" => $this->estado
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    public function edit(Codigocliente $codigocliente){
        $this->codigoCliente = $codigocliente->codigoCliente;
        $this->lugar = $codigocliente->lugar;
        $this->estado = $codigocliente->estado;

        $this->codigoclienteSeleccionadoId = $codigocliente->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $codigocliente = Codigocliente::find($this->codigoclienteSeleccionadoId);
        $this->validate();
        try {
            $codigocliente->update([
                "codigoCliente" => $this->codigoCliente,
                "lugar" => $this->lugar,
                "estado" => $this->estado
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Codigocliente $codigocliente){
        try {
            $codigocliente->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function pdf(){
        $codigoclientes= Codigocliente::query();

        if(strlen($this->search)>2){
            $codigoclientes = $codigoclientes->where(function($q){
                $q->where('codigoCliente', 'like', "%" . $this->search . "%")
                    ->orWhere('lugar', 'like', "%" . $this->search . "%");
            });
        }

        if($this->iniciorangofecha!=null && $this->finalrangofecha!=null){
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $codigoclientes = $codigoclientes->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $codigoclientes = $codigoclientes->get();


        $pdf = Pdf::loadView('livewire.codigoclientes.pdf', compact('codigoclientes'))->setPaper('letter','')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'export_protocol.pdf');

    }
}
