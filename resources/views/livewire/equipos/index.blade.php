<div>
    <div class="row">
        <div class="col-2 bg-light">
            <h1>Equipos</h1>
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
        <div class="col-4">
            <label for="">Buscador:</label>
            <input type="text" class="form-control" placeholder="Modelo/MAC" wire:model="search">
        </div>
        <div class="col-2">
            <br>
            <select name="" id="" class="form-select" wire:model="search">
                <option value="Tipo">Tipo</option>
                <option value="RF">RF</option>
                <option value="FO">FO</option>
            </select>
        </div>
        <div class="col-2">
            <br>
            <select name="" id="" class="form-select" wire:model="search">
                <option value="Estado">Estado</option>
                <option value="Disponible">Disponible</option>
                <option value="Ocupado">Ocupado</option>
            </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formequipos">Agregar</button>
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
                        <th scope="col">Modelo</th>
                        <th scope="col">Mac</th>
                        <th scope="col">Tipo de Equipo</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                    <tr class="table-light">
                        <td>{{$equipo->id}}</td>
                        <td>{{$equipo->modelo}}</td>
                        <td>{{$equipo->mac}}</td>
                        <td>{{$equipo->tipoEquipo}}</td>
                        <td>{{$equipo->estado}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$equipo}})">Editar</button>
                            <button type="button" class="btn btn-danger" wire:click="destroy({{$equipo}})">Eliminar</button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.equipos.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formequipos').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formequipos').modal('show');
        })
    </script>
</div>
