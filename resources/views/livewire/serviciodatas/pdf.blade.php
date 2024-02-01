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
    <h1 class="text-center">Registro Clientes</h1>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Codigo</th>
                <th scope="col">Cliente</th>
                <th scope="col">Plan</th>
                <th scope="col">Velocidad</th>
                <th scope="col">Precio total</th>
                <th scope="col">SSID</th>
                <th scope="col">Equipo (MAC)</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Fecha de Vencimiento</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($serviciosList as $servicio)

            <tr>
                <td>{{$servicio->id}}</td>
                <td>{{$servicio->cliente->codigocliente->codigoCliente}}</td>
                <td>{{$servicio->cliente->nombre}}</td>
                <td>{{$servicio->plan->nombrePlan}}</td>
                <td>{{$servicio->plan->velocidad->cantVelocidad}}</td>
                <td>{{$servicio->preciototal}}</td>
                <td>{{$servicio->ssid}}</td>
                <td>{{$servicio->equipo->mac}}</td>
                <td>{{$servicio->fecha_inicio}}</td>
                <td>{{$servicio->fecha_vence}}</td>
                <td>{{$servicio->estado}}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
