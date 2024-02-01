<?php

namespace App\Http\Livewire;

use App\Models\Equipo;
use App\Models\Pago;
use App\Models\Servicio;
use App\Models\Serviciodata;
use Barryvdh\DomPDF\Facade\Pdf;
use DateInterval;
use DatePeriod;
use DateTime;
use Livewire\Component;

class Serviciodatas extends Component
{
    public $search = '';
    public $searchfecha = '';
    public $searchplan = '';
    public $searchestado = '';
    public $serviciodataSeleccionadoId;
    public $equiposeleccionado;
    public $service_port, $OLT_port, $ONT_ID, $PPPOE, $SN, $VLAN, $servicio_id, $iniciorangofecha, $finalrangofecha;
    public $servicioseleccionado;
    public $boolAutorizados;
    public $mode;

    protected $rules = [
        'service_port' => 'numeric',
        'OLT_port' => 'required',
        'ONT_ID' => 'numeric',
        'PPPOE' => 'required',
        'SN' => 'required',
        'VLAN' => 'numeric',
        'servicio_id' => 'not_in:Seleccione'
    ];

    protected $messages = [
        'service_port.numeric' => 'El campo debe ser numerico',
        'service_port.min' => 'El campo debe tener al menos 6 caracteres',
        'OLT_port.required' => 'El campo no puede estar vacio',
        'ONT_ID.numeric' => 'El campo debe ser numerico',
        'PPPOE.required' => 'El campo no puede estar vacio',
        'SN.required' => 'El campo no puede estar vacio',
        'VLAN.numeric' => 'El campo debe ser numerico',
        'servicio_id.not_in' => 'Debe seleccionar un codigo de servicio'
    ];

    public function mount()
    {
        $this->servicio_id = "Seleccione";
    }



    public function render()
    {
        $serviciodatas = Serviciodata::all();

        if (!$this->boolAutorizados) {
            $servicios = Servicio::where('estado', '=', 'No Autorizado');
            $serviciosList = $servicios->get();
        } else {
            $servicios = Servicio::where('estado', '=', 'Autorizado');

            if (strlen($this->search) > 2) {
                $servicios = $servicios->where(function ($q) {
                    $q->where('fecha_inicio', 'like', "%" . $this->search . "%")
                        ->orWhere('estado', 'like', "%" . $this->search . "%")
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
                            $queryp->where('nombrePlan', 'like', "%" . $this->search . "%");
                        });
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
        }


        return view('livewire.serviciodatas.index', compact('serviciodatas', 'serviciosList'))
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function limpiar()
    {
        $this->service_port = null;
        $this->OLT_port = null;
        $this->ONT_ID = null;
        $this->PPPOE = null;
        $this->SN = null;
        $this->VLAN = null;
        $this->servicio_id = 'Seleccione';
        $this->serviciodataSeleccionadoId = null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function autorizarVista(Servicio $servicio)
    {
        $this->mode =  "Autorizado";
        $this->servicioseleccionado = $servicio;
        $this->equiposeleccionado = $servicio->equipo->id;
        $this->servicio_id = $servicio->id;

        $this->serviciodataSeleccionadoId = $servicio->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }


    public function autorizar()
    {
        $this->validate();
        try {
            Serviciodata::create([
                "service_port" => $this->service_port,
                "OLT_port" => $this->OLT_port,
                "ONT_ID" => $this->ONT_ID,
                "PPPOE" => $this->PPPOE,
                "SN" => $this->SN,
                "VLAN" => $this->VLAN,
                "servicio_id" => $this->servicio_id
            ]);

            $servicio = Servicio::find($this->serviciodataSeleccionadoId);
            $servicio->update([
                "estado" => 'Autorizado',
            ]);

            $equipo = Equipo::find($this->equiposeleccionado);
            $equipo->update([
                "estado" => 'Ocupado',
            ]);



            $start    = (new DateTime($servicio->fecha_inicio))->modify('first day of this month');
            $end      = (new DateTime($servicio->fecha_vence))->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 month');
            $period   = new DatePeriod($start, $interval, $end);

            foreach ($period as $dt) {
                $mes = $dt->format("Y-m");
                Pago::create([
                    "montopagado" => $servicio->preciototal,
                    "mes" => $mes,
                    "estado" => 'Pendiente',
                    "servicio_id" => $servicio->id
                ]);
            }

            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit(Servicio $servicio)
    {
        $this->mode =  "Editar";

        $this->servicioseleccionado = $servicio;
        $this->equiposeleccionado = $servicio->equipo->id;
        $this->servicio_id = $this->servicioseleccionado->id;

        $serviciodata = $servicio->serviciodata;

        $this->serviciodataSeleccionadoId = $serviciodata->id;


        $this->service_port = $serviciodata->service_port;
        $this->OLT_port = $serviciodata->OLT_port;
        $this->ONT_ID = $serviciodata->ONT_ID;
        $this->PPPOE = $serviciodata->PPPOE;
        $this->SN = $serviciodata->SN;
        $this->VLAN = $serviciodata->VLAN;

        $this->servicio_id = $serviciodata->servicio_id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update()
    {
        $serviciodata = Serviciodata::find($this->serviciodataSeleccionadoId);
        $this->validate();
        try {
            $serviciodata->update([
                "service_port" => $this->service_port,
                "OLT_port" => $this->OLT_port,
                "ONT_ID" => $this->ONT_ID,
                "PPPOE" => $this->PPPOE,
                "SN" => $this->SN,
                "VLAN" => $this->VLAN,
                "servicio_id" => $this->servicio_id
            ]);

            $equipo = Equipo::find($this->equiposeleccionado);
            $equipo->update([
                "estado" => 'Ocupado',
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function destroy(Servicio $servicio)
    {
        try {
            $serviciodata = $servicio->serviciodata;
            $serviciodata->delete();
            $servicio->update([
                "estado" => 'No Autorizado',
            ]);

            $equipo = $servicio->equipo;
            $equipo->update([
                "estado" => 'Disponible',
            ]);

            $pago = $servicio->pago->where('estado', '=', 'Pendiente');
            $pago->map->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }


    public function pdf()
    {
        if (!$this->boolAutorizados) {
            $servicios = Servicio::where('estado', '=', 'No Autorizado');
            $serviciosList = $servicios->get();
        } else {
            $servicios = Servicio::where('estado', '=', 'Autorizado');

            if (strlen($this->search) > 2) {
                $servicios = $servicios->where(function ($q) {
                    $q->where('fecha_inicio', 'like', "%" . $this->search . "%")
                        ->orWhere('estado', 'like', "%" . $this->search . "%")
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
                            $queryp->where('nombrePlan', 'like', "%" . $this->search . "%");
                        });
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
        }
        $pdf = Pdf::loadView('livewire.serviciodatas.pdf', compact('serviciosList'))->setPaper('letter', '')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'export_protocol.pdf'
        );
    }
}
