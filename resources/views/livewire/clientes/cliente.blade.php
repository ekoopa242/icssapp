<!-- Modal -->
<div wire:ignore.self role="dialog" class="modal fade" id="formClienteSeleccionado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Clientes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if ($clienteseleccionado != null)
                    <b>Nombre del Cliente</b>
                    <p>{{$clienteseleccionado->nombre}}</p>
                    <b>Direccion</b>
                    <p>{{$clienteseleccionado->direccion}}</p>
                    <b>Numero de Telefono</b>
                    <p>{{$clienteseleccionado->telefono}}</p>
                    <b>Codigo de Cliente</b>
                    <p>{{$clienteseleccionado->codigoCliente->codigoCliente}} | {{$clienteseleccionado->codigoCliente->lugar}}</p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="limpiar()">Close</button>
            </div>
        </div>
    </div>
</div>
