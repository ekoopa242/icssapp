<div>
    <div class="row">
        <div class="col-3 bg-light">
            <h1>Plan de Internet</h1>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formPlans">Agregar</button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Plan</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad de Velocidad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                    <tr class="table-light">
                        <td>{{$plan->id}}</td>
                        <td>{{$plan->nombrePlan}}</td>
                        <td>{{$plan->precio}}</td>
                        <td>{{$plan->velocidad->cantVelocidad}}</td>
                        <td>
                            <button type="button" class="btn btn-warning" wire:click="edit({{$plan}})">Editar</button>
                            <!-- <button type="button" class="btn btn-danger" wire:click="destroy({{$plan}})">Eliminar</button> -->
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    @include('livewire.plans.form')

    <script>
        window.addEventListener('ocultarModal', event => {
            console.log('hola');
            $('#formPlans').modal('hide');
        })

        window.addEventListener('mostrarModal', event => {
            console.log('hola');
            $('#formPlans').modal('show');
        })
    </script>
</div>
