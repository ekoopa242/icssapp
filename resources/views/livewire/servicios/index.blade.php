<div>
    <div class="row">
        <div class="col-2 bg-light"><h1>Instalacion</h1></div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <label for="">Desde:</label>
            <input type="date" class="form-control" wire:model="iniciorangofecha">
        </div>
        <div class="col-4">
            <label for="">Hasta:</label>
            <input type="date" class="form-control" wire:model="finalrangofecha">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <label for="">Fecha Inicio:</label>
            <input type="date" class="form-control" wire:model="searchfecha">
        </div>
        <div class="col-4">
            <label for="">Buscador:</label>
            <input type="text" class="form-control" placeholder="Cliente/Codigo de Cliente/MAC/Estado/Plan" wire:model="search">
        </div>
    </div>
    <hr>
    <br>
    <div class="row">
        <div class="col-2">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formservicios">Agregar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Plan</th>
                        <th scope="col">Velocidad</th>
                        <th scope="col">Precio total</th>
                        <th scope="col">SSID</th>
                        <th scope="col">Equipo (MAC)</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($serviciosList as $servicio)
                    <tr class="table-light">
                        <td>{{$servicio->id}}</td>
                        <td>{{$servicio->cliente->codigocliente->codigoCliente}}</td>
                        <td>{{$servicio->cliente->nombre}}</td>
                        <td>{{$servicio->plan->nombrePlan}}</td>
                        <td>{{$servicio->plan->velocidad->cantVelocidad}}</td>
                        <td>{{$servicio->preciototal}}</td>
                        <td>{{$servicio->ssid}}</td>
                        <td>{{$servicio->equipo->mac}}</td>
                        <td>{{$servicio->fecha_inicio}}</td>
                        <td>{{$servicio->fecha_vence}}</td>
                        <td>{{$servicio->estado}}</td>
                        <td>
                            @if($servicio->estado == 'Autorizado')
                            <button type="button" class="btn btn-info" wire:click="view({{$servicio}})">Ver</button>
                            @endif
                            @if($servicio->estado == 'No Autorizado')
                            <button type="button" class="btn btn-warning" wire:click="edit({{$servicio}})">Editar</button>
                            <button type="button" class="btn btn-danger" wire:click="destroy({{$servicio}})">Eliminar</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.servicios.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formservicios').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formservicios').modal('show');
        })
    </script>
</div>
