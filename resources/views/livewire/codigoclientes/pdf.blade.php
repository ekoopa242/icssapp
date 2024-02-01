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
    <h1 class="text-center">Registro Codigo de Clientes</h1>
    <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo de Cliente</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($codigoclientes as $codigocliente)
                <tr>
                    <td>{{$codigocliente->id}}</td>
                    <td>{{$codigocliente->codigoCliente}}</td>
                    <td>{{$codigocliente->lugar}}</td>
                    <td>{{$codigocliente->estado}}</td>
                </tr>
                @endforeach

            </tbody>
        </table>
</body>

</html>
