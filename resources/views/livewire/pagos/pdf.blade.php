<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        .cabecera {
            background-color: black;
            color: white;
        }
    </style>

    @livewireStyles
</head>

<body>
    <h1 class="text-center">Registro Codigo de Clientes</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Monto pagado</th>
                <th scope="col">Mes</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo de Pago</th>
                <th scope="col">Comentario</th>
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

            <tr">
                <td>{{$pago->id}}</td>
                <td>{{$pago->montopagado}}</td>
                <td>{{$pago->mes}}</td>
                <td>{{$pago->estado}}</td>
                <td>{{$pago->tipopago}}</td>
                <td>{{$pago->comentario}}</td>
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
</body>

</html>
