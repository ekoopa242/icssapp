<div>
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formrols">Agregar</button>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Rol</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rols as $rol)
                <tr>
                    <td>{{$rol->id}}</td>
                    <td>{{$rol->rol}}</td>
                    <td>
                        <button type="button" class="btn btn-warning" wire:click="edit({{$rol}})">Editar</button>
                        <button type="button" class="btn btn-danger" wire:click="destroy({{$rol}})">Eliminar</button>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    @include('livewire.rols.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formrols').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formrols').modal('show');
        })
    </script>
</div>
