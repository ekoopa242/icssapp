<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formserviciodatas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Autorizacion @if($serviciodataSeleccionadoId > 0) Editar @else Crear @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click="limpiar()"></button>
            </div>
            @if ($servicioseleccionado != null)
            <div class="modal-body">
                <div class="row">
                    <p>Contrato Servicio</p>
                </div>
                <div class="row">
                    <div class="col-4">
                        <b>Cliente</b>
                        <p>{{$servicioseleccionado->cliente->nombre}}</p>
                    </div>
                    <div class="col-4">
                        <b>Codigo de Cliente</b>
                        <p>{{$servicioseleccionado->cliente->codigocliente->codigoCliente}}</p>
                    </div>
                    <div class="col-4">
                        <b>Servicio</b>
                        <p>{{$servicioseleccionado->plan->nombrePlan}} | {{$servicioseleccionado->plan->velocidad->cantVelocidad}} | L.{{$servicioseleccionado->preciototal}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <b>Equipo</b>
                        <p>{{$servicioseleccionado->equipo->mac}} | {{$servicioseleccionado->equipo->modelo}}</p>
                    </div>
                    <div class="col-4">
                        <b>Fecha Inicio</b>
                        <p>{{$servicioseleccionado->fecha_inicio}}</p>
                    </div>
                    <div class="col-4">
                        <b>Fecha Limite</b>
                        <p>{{$servicioseleccionado->fecha_vence}}</p>
                    </div>
                </div>
                <div class="row">
                    <iframe width="500" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$servicioseleccionado->latitud}},{{$servicioseleccionado->longitud}}&hl=es&z=14&amp;output=embed">
                    </iframe>
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">service_port:</label>
                            <input type="text" class="form-control" wire:model.lazy="service_port">
                            @error('service_port') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">OLT_port</label>
                            <input type="text" class="form-control" wire:model.lazy="OLT_port">
                            @error('OLT_port') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">ONT_ID</label>
                            <input type="text" class="form-control" wire:model.lazy="ONT_ID">
                            @error('ONT_ID') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">PPPOE</label>
                            <input type="text" class="form-control" wire:model.lazy="PPPOE">
                            @error('PPPOE') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">SN</label>
                            <input type="text" class="form-control" wire:model.lazy="SN">
                            @error('SN') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="col-sm-2 col-form-label">VLAN</label>
                            <input type="text" class="form-control" wire:model.lazy="VLAN">
                            @error('VLAN') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Cerrar</button>

                @if ($mode == "Autorizado")
                <button type="button" class="btn btn-dark" wire:click="autorizar()">Autorizar</button>
                @elseif ($mode == "Editar")
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar cambios</button>
                @endif
            </div>
        </div>
    </div>
</div>
