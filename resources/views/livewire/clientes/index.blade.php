<div>
    <div class="row">
        <div class="col-2 bg-light"><h1>Clientes</h1></div>
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
    <br>
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formClientes">Agregar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3">
            <a class="btn btn-success" wire:click="pdf">PDF</a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Codigo del Cliente</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr class="table-light">
                        <td>{{$cliente->id}}</td>
                        <td><a href="#" data-bs-toggle="modal" data-bs-target="#formClienteSeleccionado" wire:click="seleccion({{$cliente}})">{{$cliente->nombre}}</a></td>
                        <td>{{$cliente->direccion}}</td>
                        <td>{{$cliente->telefono}}</td>
                        <td>{{$cliente->sexo}}</td>
                        <td>{{$cliente->codigocliente->codigoCliente}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$cliente}})">Editar</button>
                            <button type="button" class="btn btn-danger" wire:click="destroy({{$cliente}})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.clientes.form')
    @include('livewire.clientes.cliente')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formClientes').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formClientes').modal('show');
        })
    </script>
</div>
