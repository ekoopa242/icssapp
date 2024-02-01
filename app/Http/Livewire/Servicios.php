<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Codigocliente;
use App\Models\Empleado;
use App\Models\Equipo;
use App\Models\Plan;
use App\Models\Servicio;
use App\Models\User;
use App\Models\Velocidad;
use Livewire\Component;

class Servicios extends Component
{
    public $search = '';
    public $searchfecha = '';
    public $searchplan = '';
    public $searchestado = '';
    public $coordenadas;
    public $servicioSeleccionadoId;
    public $ssid, $password, $fecha_inicio, $fecha_vence, $estado, $referencia, $latitud, $longitud, $estadomac, $user_id, $cliente_id, $iniciorangofecha, $finalrangofecha;
    public $codigoCliente, $clientes = [], $clienteRBSeleccionado, $codCliente;
    public $mac, $macResultado, $macSeleccionadoId;
    public $plans, $velocidads;
    public $selectedplan = "Seleccione", $selectedvelocidad = "Seleccione", $preciototal;
    public $deshabilitado = false;


    protected $rules = [
        'ssid' => 'required',
        'password' => 'required',
        'fecha_inicio' => 'required|date',
        'fecha_vence' => 'required|date',
        'preciototal' => 'numeric',
        'user_id' => 'not_in:Seleccione',
        'codCliente' => 'required',
        'selectedplan' => 'not_in:Seleccione',
        'mac' => 'required',
        'estadomac' => 'required|not_in:Ocupado',
        'codigoCliente' => 'nullable',
        'referencia' => 'required',
        'latitud' => 'required',
        'longitud' => 'required'

    ];

    protected $messages = [
        'ssid.required' => 'El campo no puede estar vacio',
        'password.required' => 'El campo no puede estar vacio',
        'fecha_inicio.required' => 'El campo no puede estar vacio',
        'fecha_vence.required' => 'El campo no puede estar vacio',
        'fecha_inicio.date' => 'Debe ser formato de fecha',
        'fecha_vence.date' => 'Debe ser formato de fecha',
        'preciototal.numeric' => 'El campo debe ser numerico flotante',
        'user_id.not_in' => 'Debe seleccionar un usuario',
        'codCliente.not_in' => 'El campo no puede estar vacio',
        'selectedplan.not_in' => 'Debe seleccionar un plan',
        'mac.required' => 'Escriba la mac del equipo',
        'estadomac.required' => 'Debe seleccionar un equipo',
        'estadomac.not_in' => 'Este equipo esta ocupado',
        'referencia.required' => 'El campo no puede estar vacio',
        'latitud.required' => 'El campo no puede estar vacio',
        'longitud.required' => 'El campo no puede estar vacio'
    ];

    public function mount()
    {
        $this->user_id = "Seleccione";
        $this->selectedplan = "Seleccione";
        $this->velocidads = [];
    }

    public function render()
    {
        $servicios = Servicio::query();


        if (strlen($this->search) > 2) {
            $servicios = $servicios->where(function ($qe) {
                $qe->where('estado', 'like', '%' . $this->search . '%');
            })
                ->orWhereHas('cliente', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->search . '%')
                        ->orWhereHas('codigocliente', function ($innerQuery) {
                            // Aquí puedes agregar más condiciones para la segunda relación
                            $innerQuery->where('codigoCliente', 'like', '%' . $this->search . '%');
                        });
                })
                ->orWhereHas('equipo', function ($innerQuery2) {
                    // Aquí puedes agregar más condiciones para la segunda relación
                    $innerQuery2->where('mac', 'like', '%' . $this->search . '%')
                        ->orWhere('modelo', 'like', "%" . $this->search . "%");
                })
                ->orWhereHas('plan', function ($queryp) {
                    $queryp->where('nombrePlan', 'like', '%' . $this->search . '%');
                });
        }

        if (strlen($this->searchfecha) > 1) {
            $servicios = $servicios->where(function ($qm) {
                $qm->where('fecha_inicio', 'like', "%" . $this->searchfecha . "%");
            });
        }

        if ($this->iniciorangofecha != null && $this->finalrangofecha != null) {
            $iniciorangofecha = date('Y-m-d 00:00:00', strtotime($this->iniciorangofecha));
            $finalrangofecha = date('Y-m-d 23:59:59', strtotime($this->finalrangofecha));
            $servicios = $servicios->whereBetween('created_at', [$iniciorangofecha, $finalrangofecha]);
        }

        $serviciosList = $servicios->get();

        $users = User::orderBy('name')->get();
        $clientes = Cliente::orderBy('nombre')->get();
        $equipos = Equipo::orderBy('mac')->get();

        $this->plans = Plan::get();


        return view('livewire.servicios.index', compact('serviciosList', 'users', 'clientes', 'equipos'))
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function limpiar()
    {
        $this->ssid = null;
        $this->password = null;
        $this->fecha_inicio = null;
        $this->fecha_vence = null;
        $this->preciototal = null;
        $this->estado = 'Seleccione';
        $this->user_id = 'Seleccione';
        $this->codCliente = null;
        $this->selectedplan = 'Seleccione';
        $this->mac = null;
        $this->servicioSeleccionadoId = null;
        $this->referencia = null;
        $this->latitud = null;
        $this->longitud = null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function ocupar(Equipo $equipo)
    {
        $this->macResultado = $equipo->id;

        $this->servicioSeleccionadoId = $equipo->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function store()
    {
        $this->validate();
        try {
            Servicio::create([
                "ssid" => $this->ssid,
                "password" => $this->password,
                "fecha_inicio" => date('Y-m-d', strtotime($this->fecha_inicio)),
                "fecha_vence" => date('Y-m-d', strtotime($this->fecha_vence)),
                "preciototal" => $this->preciototal,
                "estado" =>  'No Autorizado',
                "referencia" =>  $this->referencia,
                "latitud" =>  $this->latitud,
                "longitud" =>  $this->longitud,
                "user_id" => $this->user_id,
                "cliente_id" => $this->cliente_id,
                "plan_id" => $this->selectedplan,
                "equipo_id" => $this->macResultado->id
            ]);

            // $this->macResultado->update([
            //     "estado" => 'Ocupado',
            // ]);



            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Servicio $servicio)
    {
        // dd($servicio);
        $this->ssid = $servicio->ssid;
        $this->password = $servicio->password;
        $this->fecha_inicio = $servicio->fecha_inicio;
        $this->fecha_vence = $servicio->fecha_vence;
        $this->preciototal = $servicio->preciototal;
        $this->estado = $servicio->estado;
        $this->referencia = $servicio->referencia;
        $this->latitud = $servicio->latitud;
        $this->longitud = $servicio->longitud;
        $this->user_id = $servicio->user_id;

        $this->cliente_id = $servicio->cliente_id;

        $this->codCliente = $servicio->cliente->codigocliente->codigoCliente;
        $this->updatedCodCliente($this->codCliente);

        $this->selectedplan = $servicio->plan->id;
        $this->updatedSelectedplan($this->selectedplan);

        $this->mac = $servicio->equipo->mac;
        $this->updatedMac($this->mac);

        $this->servicioSeleccionadoId = $servicio->id;

        // $this->macResultado->update([
        //     "estado" => 'Disponible',
        // ]);

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function view(Servicio $servicio)
    {
        // dd($servicio);

        $this->deshabilitado = true;

        $this->ssid = $servicio->ssid;
        $this->password = $servicio->password;
        $this->fecha_inicio = $servicio->fecha_inicio;
        $this->fecha_vence = $servicio->fecha_vence;
        $this->preciototal = $servicio->preciototal;
        $this->estado = $servicio->estado;
        $this->referencia = $servicio->referencia;
        $this->latitud = $servicio->latitud;
        $this->longitud = $servicio->longitud;
        $this->user_id = $servicio->user_id;

        $this->cliente_id = $servicio->cliente_id;

        $this->codCliente = $servicio->cliente->codigocliente->codigoCliente;
        $this->updatedCodCliente($this->codCliente);

        $this->selectedplan = $servicio->plan->id;
        $this->updatedSelectedplan($this->selectedplan);

        $this->mac = $servicio->equipo->mac;
        $this->updatedMac($this->mac);

        $this->servicioSeleccionadoId = $servicio->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update()
    {
        $servicio = Servicio::find($this->servicioSeleccionadoId);
        $this->validate();
        try {
            $servicio->update([
                "ssid" => $this->ssid,
                "password" => $this->password,
                "fecha_inicio" => $this->fecha_inicio,
                "fecha_vence" => $this->fecha_vence,
                "preciototal" => $this->preciototal,
                "estado" => $this->estado,
                "referencia" => $this->referencia,
                "latitud" => $this->latitud,
                "longitud" => $this->longitud,
                "user_id" => $this->user_id,
                "cliente_id" => $this->cliente_id,
                "plan_id" => $this->selectedplan,
                "equipo_id" => $this->macResultado->id
            ]);

            // $this->macResultado->update([
            //     "estado" => 'Ocupado',
            // ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Servicio $servicio)
    {
        try {
            $equipo = $servicio->equipo;
            $equipo->update([
                "estado" => 'Disponible',
            ]);
            $servicio->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updatedCodCliente($value)
    {
        if (strlen($value) > 3) {
            $this->codigoCliente = Codigocliente::where('codigoCliente',  'like', '%' . $value . '%')->first();
            if ($this->codigoCliente) {
                $this->clientes = Cliente::where('codigoCliente_id',  '=', $this->codigoCliente->id)->get();
            } else {
                $this->codigoCliente = null;
            }
        }
    }

    public function updatedMac($value)
    {
        if (strlen($value) > 3) {
            $macResultado = Equipo::where('mac',  'like', '%' . $value . '%')->first();
            if ($macResultado) {
                $this->macResultado = $macResultado;
                $this->estadomac = $macResultado->estado;
            } else {
                $this->macResultado = null;
            }
        }
    }


    public function updatedSelectedplan($value)
    {
        $plan = Plan::find($value);
        $this->preciototal = $plan->precio;
    }

    public function updatedCoordenadas($value)
    {
        $this->coordenadas = str_replace(array('(', ')'), '', $this->coordenadas);
        $valores = explode(',', $this->coordenadas);
        if (count($valores) >= 2) {
            $this->latitud = $valores[0];
            $this->longitud = $valores[1];
        } else {
            $this->latitud = null;  // Otra opción podría ser asignar 'null'
            $this->longitud = null; // O cualquier otro valor que indique falta de datos
        }
    }
}
