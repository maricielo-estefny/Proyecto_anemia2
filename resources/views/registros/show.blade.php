@extends('layout.plantilla')

@section('contenido')
    <div class="container mt-5">
        <div class="section-title text-center" data-aos="fade-up">
            <h2>Detalles del Registro</h2>
        </div>

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h4>Información del Registro</h4>
                <!-- Información del paciente (mantiene el código existente) -->
                @if($registro->nombre_apellido)
                    <p><strong>Nombre:</strong> {{ $registro->nombre_apellido }}</p>
                @endif
                @if($registro->dni)
                    <p><strong>DNI:</strong> {{ $registro->dni }}</p>
                @endif
                @if($registro->fecha)
                    <p><strong>Fecha:</strong> {{ $registro->fecha }}</p>
                @endif
                @if($registro->hora)
                    <p><strong>Hora:</strong> {{ $registro->hora }}</p>
                @endif
                @if($registro->edad)
                    <p><strong>Edad:</strong> {{ $registro->edad }}</p>
                @endif
                @if($registro->sexo)
                    <p><strong>Sexo:</strong> {{ $registro->sexo == 'M' ? 'Hombre' : 'Mujer' }}</p>
                @endif
                @if($registro->hmg)
                    <p><strong>HMG:</strong> {{ $registro->hmg }}</p>
                @endif
                @if($registro->RBC)
                    <p><strong>RBC:</strong> {{ $registro->RBC }}</p>
                @endif
                @if($registro->PCV)
                    <p><strong>PCV:</strong> {{ $registro->PCV }}</p>
                @endif
                @if($registro->MCV)
                    <p><strong>MCV:</strong> {{ $registro->MCV }}</p>
                @endif
                @if($registro->MCH)
                    <p><strong>MCH:</strong> {{ $registro->MCH }}</p>
                @endif
                @if($registro->MCHC)
                    <p><strong>MCHC:</strong> {{ $registro->MCHC }}</p>
                @endif
                @if($registro->RDW)
                    <p><strong>RDW:</strong> {{ $registro->RDW }}</p>
                @endif
                @if($registro->TLC)
                    <p><strong>TLC:</strong> {{ $registro->TLC }}</p>
                @endif
                @if($registro->PLT)
                    <p><strong>PLT:</strong> {{ $registro->PLT }}</p>
                @endif
                @if($registro->tipo_prediccion)
                    <p><strong>Tipo de prueba:</strong> 
                        @if($registro->tipo_prediccion == 1)
                            Anemia
                        @elseif($registro->tipo_prediccion == 2)
                            Tipo de Anemia
                        @elseif($registro->tipo_prediccion == 3)
                            Grado de Severidad
                        @endif
                    </p>
                @endif

                @if($registro->resultado)
                    <p><strong>Resultado de la Prueba:</strong> {{ $registro->resultado }}</p>
                @endif

                <a href="{{ route('registros.index') }}" class="btn btn-primary">Volver a Registros</a>
                
                <a href="{{ route('chat2') }}" class="btn btn-primary">Enviar Imagen</a>

                <!-- Botón que abre el modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#whatsappModal">Enviar a WhatsApp</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="whatsappModal" tabindex="-1" aria-labelledby="whatsappModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="whatsappModalLabel">Enviar Información a WhatsApp</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="whatsappForm">
                        @csrf
                        <div class="form-group">
                            <label for="phone">Ingrese su número!</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Ingrese el número de teléfono">
                        </div>
                        <input type="hidden" name="datos" value="{{ json_encode($registro) }}">
                        <button type="button" id="sendMessageBtn" class="btn btn-success w-100">Enviar</button>
                    </form>
                    <div id="alertMessage" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('sendMessageBtn').addEventListener('click', function() {
            const phone = document.getElementById('phone').value;
            const datos = document.querySelector('input[name="datos"]').value;
            const csrfToken = document.querySelector('input[name="_token"]').value;
            // Mostrar el indicador de carga con SweetAlert2
           
            fetch('{{ route('chatR') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ phone, datos }),
            })
            .then(response => response.json())
            .then(data => {
                const alertMessage = document.getElementById('alertMessage');
                alertMessage.innerHTML = data.success
                    ? `<div class="alert alert-success fade show">${data.message}</div>`
                    : `<div class="alert alert-danger fade show">${data.message}</div>`;
                
                // Ocultar el mensaje después de 3 segundos
                setTimeout(() => {
                    alertMessage.innerHTML = '';
                }, 3000);
            })
            .catch(error => {
                const alertMessage = document.getElementById('alertMessage');
                alertMessage.innerHTML = `<div class="alert alert-danger fade show">Error al enviar el mensaje.</div>`;
                
                // Ocultar el mensaje después de 3 segundos
                setTimeout(() => {
                    alertMessage.innerHTML = '';
                }, 3000);
            });
        });
    </script>
@endsection