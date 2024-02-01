<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    .cabecera{
        background-color: black;
        color: white;
    }
    </style>

    @livewireStyles
</head>

<body>
    <h1 class="text-center">Registro Clientes</h1>
    <table class="table table-striped table-hover">
        <thead class="cabecera">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Direccion</th>
                <th scope="col">Telefono</th>
                <th scope="col">Sexo</th>
                <th scope="col">Codigo del Cliente</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{$cliente->id}}</td>
                <td><a href="#" data-bs-toggle="modal" data-bs-target="#formClienteSeleccionado" wire:click="seleccion({{$cliente}})">{{$cliente->nombre}}</a></td>
                <td>{{$cliente->direccion}}</td>
                <td>{{$cliente->telefono}}</td>
                <td>{{$cliente->sexo}}</td>
                <td>{{$cliente->codigocliente->codigoCliente}}</td>
            </tr>
            @endforeach


        </tbody>
    </table>
</body>

</html>
