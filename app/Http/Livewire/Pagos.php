<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use App\Models\Servicio;
use Barryvdh\DomPDF\Facade\Pdf;
use DateInterval;
use DatePeriod;
use Livewire\Component;
use DateTime;


class Pagos extends Component
{
    public $search = '';
    public $searchmes = '';
    public $pagoSeleccionadoId;
    public $pagoseleccionado;
    public $montopagado, $mes, $estado, $tipopago, $comentario, $servicio_id, $iniciorangofecha, $finalrangofecha, $estadoAnterior;

    protected $rules = [
        'montopagado' => 'numeric',
        'mes' => 'required',
        'estado' => 'not_in:Seleccione',
        'tipopago'=> 'not_in:Seleccione',
    ];

    protected $messages = [
        'montopagado.numeric' => 'El campo de ser numerico',
        'mes.required' => 'El campo no puede estar vacio',
        'estado.not_in' => 'Debe seleccionar un estado',
        'tipopago.not_in' => 'Debe seleccionar un tipopago',
    ];

    public function mount(){
        $this->tipopago = "Seleccione";
        $this->estado = "Seleccione";
    }


    public function render()
    {
        $pagos = Pago::query();

        if(strlen($this->search)>2){
            $pagos = $pagos->where(function($q){
                $q->where('tipopago', 'like', "%" . $this->search . "%")
                    ->orWhere('estado', 'like', "%" . $this->search . "%")
                    ->orWhere('mes', 'like', "%" . $this->search . "%")
                    ->orWhereHas('servicio', function ($query) {
                        $query->where('ssid', 'like', '%' . $this->search . '%')
                        ->orWhereHas('cliente', function ($innerQuery) {
                            // Aquí puedes agregar más condiciones para la segunda relación
                            $innerQuery->where('nombre', 'like', '%' . $this->search . '%')
                            ->orWhereHas('codigocliente', function ($innerQuery1) {
                                // Aquí puedes agregar más condiciones para la segunda relación
                                $innerQuery1->where('codigoCliente', 'like', '%' . $this->search . '%');
                            });
                        })
                        ->orWhereHas('equipo', function ($innerQuery2) {
                            // Aquí puedes agregar más condiciones para la segunda relación
                            $innerQuery2->where('mac', 'like', '%' . $this->search . '%')
                            ->orWhere('modelo', 'like', "%" . $this->search . "%");
                        });
                    });
            });
        }

        if(strlen($this->searchmes)>1){
            $pagos = $pagos->where(function($qm){
                $qm->where('mes', 'like', "%" . $this->searchmes . "%");
            });
        }

        $pagos = $pagos->get();

        $servicios = Servicio::all();
        return view('livewire.pagos.index', compact('pagos','servicios'))
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function limpiar(){
        $this->montopagado=null;
        $this->mes=null;
        $this->estado='Seleccione';
        $this->tipopago= 'Seleccione';
        $this->comentario=null;
        $this->pagoSeleccionadoId=null;
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function seleccion(Pago $pago){
        $this->montopagado = $pago->montopagado;
        $this->mes = $pago->mes;
        $this->estado = $pago->estado;
        $this->tipopago = $pago->tipopago;
        $this->comentario = $pago->comentario;
        $this->servicio_id = $pago->servicio_id;

        $this->pagoSeleccionadoId = $pago->id;
        $this->pagoseleccionado = $pago;
        $this->servicio_id = $this->pagoseleccionado->id;

    }

    public function edit(Pago $pago){
        $this->montopagado = $pago->montopagado;
        $this->mes = $pago->mes;
        $this->estado = $pago->estado;
        $this->estadoAnterior = $pago->tipopago;
        $this->tipopago = $pago->tipopago;
        $this->comentario = $pago->comentario;
        $this->servicio_id = $pago->servicio_id;

        $this->pagoSeleccionadoId = $pago->id;
        $this->pagoseleccionado = $pago;
        $this->servicio_id = $this->pagoseleccionado->id;

        $this->dispatchBrowserEvent('mostrarModal', []);
    }

    public function update(){
        $pago = Pago::find($this->pagoSeleccionadoId);
        $this->validate();
        try {
            if($this->estado != 'Pagado'){
                $this->tipopago = '';
            }
            $pago->update([
                "montopagado" => $this->montopagado,
                "estado" => $this->estado,
                "tipopago" => $this->tipopago,
                "comentario" => $this->comentario,
            ]);
            $this->dispatchBrowserEvent('ocultarModal', []);
            $this->limpiar();

            $servicio = $pago->servicio;
            $conteopagos = Pago::where('servicio_id', '=', $servicio->id)->where('estado', '!=', 'Pagado')  ->count();
            if($conteopagos == 0 && $this->estadoAnterior != $this->estado){

                $start    = (new DateTime($pago->servicio->fecha_vence))->modify('first day of next month');
                $end      = (new DateTime(date('Y-m-d', strtotime('+1 year', strtotime($pago->servicio->fecha_vence)) )))->modify('first day of next month');
                $interval = DateInterval::createFromDateString('1 month');
                $period   = new DatePeriod($start, $interval, $end);

                foreach ($period as $dt) {
                    $mes = $dt->format("m-Y");
                    Pago::create([
                        "montopagado" => $servicio->preciototal,
                        "mes" => $mes,
                        "estado" => 'Pendiente',
                        "servicio_id" => $servicio->id
                    ]);
                }
            }

        } catch (\Throwable $th) {
            // throw $th;
        }
    }



    public function pdf(){
        $pagos = Pago::query();

        if(strlen($this->search)>2){
            $pagos = $pagos->where(function($q){
                $q->where('tipopago', 'like', "%" . $this->search . "%")
                    ->orWhere('estado', 'like', "%" . $this->search . "%")
                    ->orWhere('mes', 'like', "%" . $this->search . "%")
                    ->orWhereHas('servicio', function ($query) {
                        $query->where('ssid', 'like', '%' . $this->search . '%')
                        ->orWhereHas('cliente', function ($innerQuery) {
                            // Aquí puedes agregar más condiciones para la segunda relación
                            $innerQuery->where('nombre', 'like', '%' . $this->search . '%')
                            ->orWhereHas('codigocliente', function ($innerQuery1) {
                                // Aquí puedes agregar más condiciones para la segunda relación
                                $innerQuery1->where('codigoCliente', 'like', '%' . $this->search . '%');
                            });
                        })
                        ->orWhereHas('equipo', function ($innerQuery2) {
                            // Aquí puedes agregar más condiciones para la segunda relación
                            $innerQuery2->where('mac', 'like', '%' . $this->search . '%')
                            ->orWhere('modelo', 'like', "%" . $this->search . "%");
                        });
                    });
            });
        }

        if(strlen($this->searchmes)>1){
            $pagos = $pagos->where(function($qm){
                $qm->where('mes', 'like', "%" . $this->searchmes . "%");
            });
        }

        $pagos = $pagos->get();


        $pdf = Pdf::loadView('livewire.pagos.pdf', compact('pagos'))->setPaper('letter','')->output();
        return response()->streamDownload(
            fn () => print($pdf),
            'export_protocol.pdf');

    }
}
