<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alerta Inventario bajo</title>
</head>
<body>
    <table style="width:100%;">
        <thead style="background:#036;color:white;">
            <tr>
                <th>
                    <h4>Alerta Inventario Bajo</h4>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table>
                        <thead style="background:#036;color:white;">
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    {{$producto->nombre}}
                                </td>
                                <td>
                                    {{$producto->cantidad}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>