<div>
    <div class="row">
        <div class="col-2 bg-light"><h1>Usuarios</h1></div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr class="table-light">
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->rol}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$user}})">Editar</button>
                            <button type="button" class="btn btn-danger" wire:click="destroy({{$user}})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.usuarios.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formusuarios').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formusuarios').modal('show');
        })
    </script>
</div>
