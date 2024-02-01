<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formservicios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Empleados @if($servicioSeleccionadoId > 0) Editar @else Crear @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:model="limpiar"></button>
            </div>
            <div class="modal-body">
                <br>
                <h5 class="bg-light p-3">Cliente</h5>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="">Codigo de Cliente</label>
                            <input type="text" class="form-control" wire:model="codCliente" @disabled($deshabilitado)>
                        </div>
                        <div class="row">
                            @if ($codigoCliente)
                            <div class="col-4">
                                <b>Codigo</b>
                                <p>{{$codigoCliente->codigoCliente}}</p>
                            </div>
                            <div class="col-4">
                                <b>Lugar</b>
                                <p>{{$codigoCliente->lugar}}</p>
                            </div>
                            <div class="col-4">
                                <b>Estado</b>
                                <p>{{$codigoCliente->estado}}</p>
                            </div>
                            @endif
                        </div>
                        <div class="row">
                            <table class="table">
                                <thead>
                                    <th></th>
                                    <th>Nombre</th>
                                    <th>Telefono</th>
                                </thead>
                                <tbody>
                                    @if(count($clientes)>0)
                                    @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>
                                            <input type="radio" wire:model="cliente_id" id="clienteRB" name="clienteRB" value="{{$cliente->id}}" @disabled($deshabilitado)>
                                        </td>
                                        <td>
                                            <p>{{$cliente->nombre}}</p>
                                        </td>
                                        <td>
                                            <p>{{$cliente->telefono}}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <h5 class="bg-light p-3">Equipo</h5>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="">MAC</label>
                            <input type="text" class="form-control" wire:model="mac" @disabled($deshabilitado)>
                            @error('mac') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            @if ($macResultado)
                            <div class="col-4">
                                <b>MAC</b>
                                <p>{{$macResultado->mac}}</p>
                            </div>
                            <div class="col-4">
                                <b>Modelo</b>
                                <p>{{$macResultado->modelo}}</p>
                            </div>
                            <div class="col-4">
                                <b>Tipo de Equipo</b>
                                <p>{{$macResultado->tipoEquipo}}</p>
                            </div>
                            <div class="col-4">
                                <b>Estado</b>
                                <p>{{$macResultado->estado}}</p>
                                @error('estadomac') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                            @endif
                        </div>


                        <br>
                        <h5 class="bg-light p-3">Plan</h5>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="">Plan</label>
                            <select class="form-select" wire:model.lazy="selectedplan" id="plan" @disabled($deshabilitado)>
                                <option value="Seleccione" disabled>Seleccione</option>
                                @foreach ($plans as $plan)
                                <option value="{{$plan->id}}">{{$plan->nombrePlan}} | {{$plan->velocidad->cantVelocidad}} | L.{{$plan->precio}}</option>
                                @endforeach
                            </select>
                            @error('nombrePlan') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Precio</label>
                            <input type="text" id="precio" wire:model.lazy="preciototal" class="form-control" @disabled($deshabilitado)>
                        </div>



                        <br>
                        <h5 class="bg-light p-3">Datos</h5>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="">SSID</label>
                            <input type="text" class="form-control" wire:model.lazy="ssid" @disabled($deshabilitado)>
                            @error('ssid') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Contraseña</label>
                            <input type="text" class="form-control" wire:model.lazy="password" @disabled($deshabilitado)>
                            @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Fecha de Inicio</label>
                            <input type="date" class="form-control" wire:model.lazy="fecha_inicio" @disabled($deshabilitado)>
                            @error('fecha_inicio') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Fecha de Vence</label>
                            <input type="date" class="form-control" wire:model.lazy="fecha_vence" @disabled($deshabilitado)>
                            @error('fecha_vence') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Usuario</label>
                            <select name="" id="" class="form-select" wire:model.lazy="user_id" @disabled($deshabilitado)>
                                <option value="Seleccione" disabled>Seleccione</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>

                        <br>
                        <h5 class="bg-light p-3">Localizacion</h5>
                        <hr>
                        <div class="form-group mb-3">
                            <label for="">Referencia</label>
                            <input type="text" class="form-control" wire:model.lazy="referencia" @disabled($deshabilitado)>
                            @error('referencia') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Ubicacion</label>
                            <input type="text" class="form-control" wire:model="coordenadas">
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" class="form-control" wire:model.lazy="latitud" disabled>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control" wire:model.lazy="longitud" disabled>
                                </div>
                            </div>
                            <br><br>
                            <div class="row">
                                <iframe width="600" height="450" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q={{$latitud}},{{$longitud}}&hl=es&z=14&amp;output=embed">
                                </iframe>
                            </div><br>

                            @error('coordenadas') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
                @if(!$deshabilitado)
                @if($servicioSeleccionadoId > 0)
                <button type="button" class="btn btn-dark" wire:click="update()">Actualizar</button>
                @else
                <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
