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
                <div class="col-md-2 text-end">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">Reportes</a>
                </div>
            </div>
        </form>

        @if(request('dni') && $registros->isNotEmpty())
            <div class="text-center mb-4">
                <a href="{{ route('registros.index') }}" class="btn btn-primary">Volver a Registros</a>
                <button id="verGrafico" class="btn btn-secondary" data-toggle="modal" data-target="#graficoModal">Ver Gráfico</button>
                
            </div>
        @endif
       <!-- Botón para abrir la ventana modal -->
        {{-- <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reportModal">Reportes</a> --}}

        <!-- Ventana Modal -->
        <!-- Ventana Modal -->
        <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Selecciona el tipo de prueba</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para seleccionar el tipo de prueba -->
                        <form id="reportForm" action="{{ route('reporte.generar') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="testType" class="form-label">Tipo de Prueba</label>
                                <select id="testType" name="testType" class="form-select" required>
                                    <option value="" disabled selected>Selecciona una opción</option>
                                    <option value="Anemia">Anemia</option>
                                    <option value="Tipo de Anemia">Tipo de Anemia</option>
                                    <option value="Grado de Severidad">Grado de Severidad</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Generar Reporte</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>



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
                                    Tipo de Anemia
                                @elseif($registro->tipo_prediccion == 3)
                                    Grado de Severidad
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
            <!-- Paginador -->
            {{-- <div class="d-flex justify-content-center">
                {{ $registros->links() }}
            </div> --}}
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="{{ $registros->previousPageUrl() }}" aria-label="Anterior">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    @for ($i = 1; $i <= $registros->lastPage(); $i++)
                        <li class="page-item {{ $i == $registros->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $registros->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item">
                        <a class="page-link" href="{{ $registros->nextPageUrl() }}" aria-label="Siguiente">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
        @else
            <div class="alert alert-info text-center" role="alert" data-aos="fade-up" data-aos-delay="100">
                No se encontraron registros para el DNI ingresado.
            </div>
        @endif
    </div>

    <!-- Modal para el gráfico -->
    <div class="modal fade" id="graficoModal" tabindex="-1" role="dialog" aria-labelledby="graficoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="graficoModalLabel">Variación de HMG</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <canvas id="hmgChart"></canvas>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#graficoModal').on('shown.bs.modal', function () {
            var ctx = document.getElementById('hmgChart').getContext('2d');

            var hmgData = @json($hmgData);
            var horaData = @json($horaData);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: horaData,
                    datasets: [{
                        label: 'HMG',
                        data: hmgData,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Hora'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'HMG'
                            }
                        }
                    }
                }
            });
        });
    });
</script>
<script>
    function verDetalles(registroId) {
        console.log('ID del registro:', registroId); // Verifica el ID del registro

        // Construir la URL correctamente usando el helper route()
        var url = '{{ route("registro.show", ":id") }}'; 
        url = url.replace(':id', registroId);

        // Fetch record details via AJAX
        $.ajax({
            url: url,
            method: 'GET',
            success: function(data) {
                console.log('Datos recibidos:', data); // Verifica los datos recibidos

                // Construye el HTML con los datos recibidos
                var detailsHtml = '<p><strong>Nombre:</strong> ' + data.nombre_apellido + '</p>' +
                                '<p><strong>DNI:</strong> ' + data.dni + '</p>' +
                                '<p><strong>Fecha:</strong> ' + data.fecha + '</p>' +
                                '<p><strong>Hora:</strong> ' + data.hora + '</p>' +
                                '<p><strong>Edad:</strong> ' + data.edad + '</p>' +
                                '<p><strong>Sexo:</strong> ' + (data.sexo == 'M' ? 'Hombre' : 'Mujer') + '</p>' +
                                '<p><strong>HMG:</strong> ' + data.hmg + '</p>' +
                                '<p><strong>RBC:</strong> ' + (data.RBC ? data.RBC : 'N/A') + '</p>' +
                                '<p><strong>PCV:</strong> ' + (data.PCV ? data.PCV : 'N/A') + '</p>' +
                                '<p><strong>MCV:</strong> ' + (data.MCV ? data.MCV : 'N/A') + '</p>' +
                                '<p><strong>MCH:</strong> ' + (data.MCH ? data.MCH : 'N/A') + '</p>' +
                                '<p><strong>MCHC:</strong> ' + (data.MCHC ? data.MCHC : 'N/A') + '</p>' +
                                '<p><strong>RDW:</strong> ' + (data.RDW ? data.RDW : 'N/A') + '</p>' +
                                '<p><strong>TLC:</strong> ' + (data.TLC ? data.TLC : 'N/A') + '</p>' +
                                '<p><strong>PLT:</strong> ' + (data.PLT ? data.PLT : 'N/A') + '</p>' +
                                '<p><strong>Tipo de Prueba:</strong> ' +
                                (data.tipo_prediccion == 1 ? 'Anemia' : data.tipo_prediccion == 2 ? 'Severidad' : 'Tipo de Anemia') + '</p>' +
                                '<p><strong>Resultado de la Prueba:</strong> ' + data.resultado + '</p>';

                // Inserta el HTML en la sección de detalles
                $('#registroDetalles').html(detailsHtml);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error en la solicitud AJAX:', textStatus, errorThrown); // Muestra errores si hay alguno
                $('#registroDetalles').html('<p class="text-danger">Error al cargar los detalles.</p>');
            }
        });
    }
</script>
@endsection
