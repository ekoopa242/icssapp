<div>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formempleados">Agregar</button>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                <tr>
                    <td>{{$empleado->id}}</td>
                    <td>{{$empleado->nombre}}</td>
                    <td>{{$empleado->apellido}}</td>
                    <td>{{$empleado->usuario}}</td>
                    <td>{{$empleado->estado}}</td>
                    <td>{{$empleado->rol->rol}}</td>
                    <td>
                        <button type="button" class="btn btn-warning" wire:click="edit({{$empleado}})">Editar</button>
                        <button type="button" class="btn btn-danger" wire:click="destroy({{$empleado}})">Eliminar</button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @include('livewire.empleados.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formempleados').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formempleados').modal('show');
        })
    </script>
</div>
