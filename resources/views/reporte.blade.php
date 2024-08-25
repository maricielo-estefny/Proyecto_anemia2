<!-- resources/views/reportes/reporte.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Registros</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Registros - Tipo de Prueba: {{ ucfirst($testType) }}</h1>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Hora</th>
                <th>Fecha</th>
                <th>Edad</th>
                <th>Sexo</th>
                <th>HMG</th>
                <th>Tipo de Prueba</th>
                <th>Resultado de la Prueba</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registros as $registro)
                <tr>
                    <td>{{ $registro->nombre_apellido }}</td>
                    <td>{{ $registro->dni }}</td>
                    <td>{{ $registro->hora }}</td>
                    <td>{{ $registro->fecha }}</td>
                    <td>{{ $registro->edad }}</td>
                    <td>{{ $registro->sexo }}</td>
                    <td>{{ $registro->hmg }}</td>
                    <td>
                        @if($registro->tipo_prediccion == 1)
                            Anemia
                        @elseif($registro->tipo_prediccion == 2)
                            Tipo de Anemia
                        @elseif($registro->tipo_prediccion == 3)
                            Grado de Severidad
                        @endif
                    </td>
                    <td>{{ $registro->resultado }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
