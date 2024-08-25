@extends('layout.plantilla')

@section('contenido')
    <div class="container mt-5">
        <div class="section-title text-center" data-aos="fade-up">
            <h2>Búsqueda de Registros</h2>
            <p>Ingresa el DNI para buscar un registro.</p>
        </div>

        <form action="{{ route('registros.index') }}" method="get" class="mb-4">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="dni" class="form-control" placeholder="Buscar por DNI" value="{{ request('dni') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if($registros->isNotEmpty())
        <div class="table-responsive" data-aos="fade-up" data-aos-delay="100">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
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
                        <th>Acciones</th>
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
                                Severidad
                            @elseif($registro->tipo_prediccion == 3)
                                Tipo de Anemia
                            @endif
                        </td>
                        <td>{{ $registro->resultado }}</td>
                        <td>
                            <a href="{{ route('registro.show', $registro->codigo) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Botón para abrir el modal con gráficos, solo cuando se haya buscado y se encuentren registros -->
        @if(request('dni'))
            <div class="mt-3">
                <a href="{{ route('registros.index') }}" class="btn btn-primary">Volver a Registros</a>
                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#graficoModal">Ver Gráficos</button>
            </div>
        @endif

        @else
        <div class="alert alert-info text-center" role="alert" data-aos="fade-up" data-aos-delay="100">
            No se encontraron registros para el DNI ingresado.
        </div>
        @endif

    </div>

    <!-- Modal para los gráficos -->
    <div class="modal fade" id="graficoModal" tabindex="-1" role="dialog" aria-labelledby="graficoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="graficoModalLabel">Gráficos del Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Lienzo para el gráfico -->
                    <canvas id="graficoLinea"></canvas>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener los datos del gráfico pasados desde el controlador
        const graficoDatos = @json($graficoDatos);

        // Extraer las etiquetas y los datos
        const labels = graficoDatos.map(dato => dato.hora);
        const data = graficoDatos.map(dato => dato.hmg);

        // Configuración del gráfico
        const ctx = document.getElementById('graficoLinea').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels, // Horas
                datasets: [{
                    label: 'HMG',
                    data: data, // Valores de HMG
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Hora'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'HMG'
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
