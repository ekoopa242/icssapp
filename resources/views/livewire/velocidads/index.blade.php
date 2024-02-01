<div>
    <div class="row">
        <div class="col-4 bg-light">
            <h1>Velocidad por Megabytes</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formvelocidads">Agregar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Velocidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($velocidads as $velocidad)
                    <tr class="table-light">
                        <td>{{$velocidad->id}}</td>
                        <td>{{$velocidad->cantVelocidad}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$velocidad}})">Editar</button>
                            <!-- <button type="button" class="btn btn-danger" wire:click="destroy({{$velocidad}})">Eliminar</button> -->
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.velocidads.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formvelocidads').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formvelocidads').modal('show');
        })
    </script>
</div>
