<div>
    <div class="row">
        <div class="col-2 bg-light">
            <h1>Pago</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <label for="">Buscar mes:</label>
            <input type="month" class="form-control" wire:model="searchmes">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-8">
            <label for="">Buscador:</label>
            <input type="text" class="form-control" wire:model="search">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-8">
            <a class="btn btn-success" wire:click="pdf">PDF</a>
        </div>
    </div>
    <div class="row">
        <div class="col-3">

        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Monto pagado</th>
                        <th scope="col">Mes</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Tipo de Pago</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Codigo</th>
                        <th scope="col">Plan</th>
                        <th scope="col">Velocidad</th>
                        <th scope="col">Equipo (MAC)</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pagos as $pago)

                    <tr class="@if ($pago->estado == 'Pagado') table-success @elseif ($pago->estado == 'Debe') table-danger @else table-info @endif">
                        <td>{{$pago->id}}</td>
                        <td>{{$pago->montopagado}}</td>
                        <td>{{$pago->mes}}</td>
                        <td>{{$pago->estado}}</td>
                        <td>{{$pago->tipopago}}</td>
                        <td>{{$pago->servicio->cliente->nombre}}</td>
                        <td>{{$pago->servicio->cliente->codigocliente->codigoCliente}}</td>
                        <td>{{$pago->servicio->plan->nombrePlan}}</td>
                        <td>{{$pago->servicio->plan->velocidad->cantVelocidad}}</td>
                        <td>{{$pago->servicio->equipo->mac}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary" wire:click="edit({{$pago}})">Editar</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.pagos.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formpagos').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formpagos').modal('show');
        })
    </script>
</div>
