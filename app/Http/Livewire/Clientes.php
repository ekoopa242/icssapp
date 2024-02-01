<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Codigocliente;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class Clientes extends Component
{
    public $search = '';
    public $clienteSeleccionadoId;
    public $clienteseleccionado;
    public $nombre, $direccion, $telefono, $sexo, $codigoCliente_id, $iniciorangofecha, $finalrangofecha;

    protected $rules = [
        'nombre' => 'required|min:6',
        'direccion' => 'required',
        'telefono' => 'numeric',
        'sexo' => 'not_in:Seleccione',
        'codigoCliente_id' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'nombre.required' => 'El campo no puede estar vacio',
        'nombre.min' => 'El campo debe tener al menos 6 caracteres',
        'direccion.required' => 'El campo no puede estar vacio',
        'telefono.numeric' => 'El campo de ser numerico',
        'sexo.not_in' => 'Debe seleccionar un sexo',
        'codigoCliente_id.not_in' => 'Debe seleccionar un codigo de cliente'
    ];

    public function mount()
    {
        $this->sexo = "Seleccione";
        $this->codigoCliente_id = "Seleccione";
    }


    public function render()
    {
        $clientes = Cliente::query();

        if (strlen($this->search) > 2) {
            $clientes = $clientes->where(function ($q) {
                $q->where('nombre', 'like', "%" . $this->search . "%")
                    ->orWhere('telefono', 'like', "%" . $this->search . "%")
                    ->orWhereHas('codigocliente', function ($query) {
                        $query->where('codigoCliente', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->iniciorangofecha != null && $this->finalrangofecha != null) {
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $clientes = $clientes->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $clientes = $clientes->get();

        $codigoclientes = Codigocliente::orderBy('codigoCliente')->get();
        return view('livewire.clientes.index', compact('clientes', 'codigoclientes'))
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function limpiar()
    {
        $this->nombre = null;
        $this->direccion = null;
        $this->telefono = null;
        $this->sexo = 'Seleccione';
        $this->codigoCliente_id = 'Seleccione';
        $this->clienteSeleccionadoId = null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $this->validate();

        try {
            Cliente::create([
                "nombre" => $this->nombre,
                "direccion" => $this->direccion,
                "telefono" => $this->telefono,
                "sexo" => $this->sexo,
                "codigoCliente_id" => $this->codigoCliente_id
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function seleccion(Cliente $cliente)
    {
        $this->nombre = $cliente->nombre;
        $this->direccion = $cliente->direccion;
        $this->telefono = $cliente->telefono;
        $this->sexo = $cliente->sexo;
        $this->codigoCliente_id = $cliente->codigoCliente_id;

        $this->clienteSeleccionadoId = $cliente->id;
        $this->clienteseleccionado = $cliente;
        //$this->codigoCliente_id = $this->clienteseleccionado->id;
    }

    public function edit(Cliente $cliente)
    {
        $this->nombre = $cliente->nombre;
        $this->direccion = $cliente->direccion;
        $this->telefono = $cliente->telefono;
        $this->sexo = $cliente->sexo;
        $this->codigoCliente_id = $cliente->codigoCliente_id;

        $this->clienteSeleccionadoId = $cliente->id;
        $this->clienteseleccionado = $cliente;
        //$this->codigoCliente_id = $this->clienteseleccionado->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update()
    {
        $cliente = Cliente::find($this->clienteSeleccionadoId);
        $this->validate();

        try {
            $cliente->update([
                "nombre" => $this->nombre,
                "direccion" => $this->direccion,
                "telefono" => $this->telefono,
                "sexo" => $this->sexo,
                "codigoCliente_id" => $this->codigoCliente_id
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }

    }



    public function pdf()
    {
        $clientes = Cliente::query();

        if (strlen($this->search) > 2) {
            $clientes = $clientes->where(function ($q) {
                $q->where('nombre', 'like', "%" . $this->search . "%")
                    ->orWhere('telefono', 'like', "%" . $this->search . "%")
                    ->orWhereHas('codigocliente', function ($query) {
                        $query->where('codigoCliente', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->iniciorangofecha != null && $this->finalrangofecha != null) {
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $clientes = $clientes->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }
        $clientes = $clientes->get();


        $pdf = Pdf::loadView('livewire.clientes.pdf', compact('clientes'))->setPaper('letter', '')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'export_protocol.pdf'
        );
    }
}
