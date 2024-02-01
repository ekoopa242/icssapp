<div>
    <div class="row">
        <div class="col-3 bg-light">
            <h1>Codigo de Clientes</h1>
        </div>
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
        <div class="col-8">
            <input type="text" class="form-control" wire:model="search">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" wire:click="pdf">PDF</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formCodigoclientes">Agregar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Codigo de Cliente</th>
                        <th scope="col">Lugar</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($codigoclientes as $codigocliente)
                    <tr class="table-light">
                        <td>{{$codigocliente->id}}</td>
                        <td>{{$codigocliente->codigoCliente}}</td>
                        <td>{{$codigocliente->lugar}}</td>
                        <td>{{$codigocliente->estado}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$codigocliente}})">Editar</button>
                            <button type="button" class="btn btn-danger" wire:click="destroy({{$codigocliente}})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.codigoclientes.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formCodigoclientes').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formCodigoclientes').modal('show');
        })
    </script>
</div>
