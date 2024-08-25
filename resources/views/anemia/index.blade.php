@extends('layout.plantilla')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('contenido')
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Predicción de Anemia</h2>
        <p>Para conocer tu predicción de anemia,
            por favor ingresa tus datos a continuación.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <form method="post" role="form" id="predictionForm">
            @csrf
            <input type="hidden" name="content" id="content">
            <div class="row" style="align-content: center,center">
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <label for="dni">DNI (8 dígitos)</label>
                    <input type="number" name="dni" class="form-control" id="dni" maxlength="8" oninput="validateLength(this)" placeholder="DNI (8 dígitos)" required>
                    @error('dni')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label for="nombre">Nombre y Apellido (solo letras y espacios)</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre y Apellido" required oninput="validateName(this)">
                    @error('nombre')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="edad">Edad (meses, 6-60)</label>
                    <input type="number" name="edad" class="form-control" id="edad" placeholder="Edad (mes)" required>
                    @error('edad')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <label for="peso">Peso (kg, 2-65)</label>
                    <input type="number" step="0.01" class="form-control" name="peso" id="peso" placeholder="Peso (kg)" required>
                    @error('peso')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <label for="altura">Altura (cm, 44-170)</label>
                    <input type="number" step="0.01" class="form-control" name="altura" id="altura" placeholder="Altura (cm)" required>
                    @error('altura')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" class="form-control" id="sexo" required>
                        <option value="" disabled selected>Seleccionar Sexo</option>
                        <option value="M">Hombre</option>
                        <option value="F">Mujer</option>
                    </select>
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <label for="hmg">Hmg (g/dl, 7-18.5)</label>
                    <input type="number" step="0.01" class="form-control" name="hmg" id="hmg" placeholder="Hmg (g/dl)" required>
                    @error('hmg')
                        <div class="alerta_perso">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <br>
           <div class="mt-3 text-center">
              <button type="submit" class="appointment-button">Predecir</button>
               
                <script>
                    function validateLength(input) {
                        if (input.value.length > 8) {
                            input.value = input.value.slice(0, 8);
                        }
                    }
                
                    function validateName(input) {
                        input.value = input.value.replace(/[^a-zA-Z\s]/g, '');
                    }
                
                    const rangoEdad = {
                        6: { 'peso_min': 5, 'peso_max': 10.5, 'altura_min': 50, 'altura_max': 72.5 },
                        7: { 'peso_min': 5.3, 'peso_max': 11.1, 'altura_min': 60.2, 'altura_max': 74.3 },
                        8: { 'peso_min': 5.6, 'peso_max': 11.5, 'altura_min': 61.8, 'altura_max': 76 },
                        9: { 'peso_min': 5.8, 'peso_max': 12, 'altura_min': 63, 'altura_max': 77.2 },
                        10: { 'peso_min': 5.9, 'peso_max': 12.4, 'altura_min': 64, 'altura_max': 79 },
                        11: { 'peso_min': 6.1, 'peso_max': 12.7, 'altura_min': 65, 'altura_max': 80.3 },
                        12: { 'peso_min': 6.3, 'peso_max': 13.1, 'altura_min': 65.1, 'altura_max': 81.8 },
                        13: { 'peso_min': 6.5, 'peso_max': 13.5, 'altura_min': 67.2, 'altura_max': 83 },
                        14: { 'peso_min': 6.6, 'peso_max': 13.8, 'altura_min': 68.1, 'altura_max': 84.5 },
                        15: { 'peso_min': 6.7, 'peso_max': 14.1, 'altura_min': 69.2, 'altura_max': 85.8 },
                        16: { 'peso_min': 6.9, 'peso_max': 14.5, 'altura_min': 70.1, 'altura_max': 87 },
                        17: { 'peso_min': 7.1, 'peso_max': 14.8, 'altura_min': 71, 'altura_max': 88 },
                        18: { 'peso_min': 7.2, 'peso_max': 15.1, 'altura_min': 72, 'altura_max': 89.2 },
                        19: { 'peso_min': 7.4, 'peso_max': 15.4, 'altura_min': 73, 'altura_max': 90.5 },
                        20: { 'peso_min': 7.5, 'peso_max': 15.7, 'altura_min': 73.8, 'altura_max': 91.8 },
                        21: { 'peso_min': 7.6, 'peso_max': 16, 'altura_min': 74.5, 'altura_max': 93 },
                        22: { 'peso_min': 7.8, 'peso_max': 16.4, 'altura_min': 75, 'altura_max': 94 },
                        23: { 'peso_min': 7.9, 'peso_max': 16.7, 'altura_min': 76, 'altura_max': 95 },
                        24: { 'peso_min': 8.1, 'peso_max': 17, 'altura_min': 76.9, 'altura_max': 96 },
                        25: { 'peso_min': 8.1, 'peso_max': 17.2, 'altura_min': 77, 'altura_max': 95.4 },
                        26: { 'peso_min': 8.2, 'peso_max': 17.4, 'altura_min': 78.4, 'altura_max': 97.5 },
                        27: { 'peso_min': 8.3, 'peso_max': 18, 'altura_min': 78, 'altura_max': 98.7 },
                        28: { 'peso_min': 8.4, 'peso_max': 18.2, 'altura_min': 79, 'altura_max': 99 },
                        29: { 'peso_min': 8.9, 'peso_max': 18.8, 'altura_min': 79.2, 'altura_max': 100.2 },
                        30: { 'peso_min': 8.9, 'peso_max': 19, 'altura_min': 80, 'altura_max': 101 },
                        31: { 'peso_min': 9, 'peso_max': 19.2, 'altura_min': 80.6, 'altura_max': 102 },
                        32: { 'peso_min': 9.1, 'peso_max': 19.3, 'altura_min': 81.5, 'altura_max': 103 },
                        33: { 'peso_min': 9.2, 'peso_max': 20, 'altura_min': 82, 'altura_max': 104 },
                        34: { 'peso_min': 9.5, 'peso_max': 20.2, 'altura_min': 82.7, 'altura_max': 105 },
                        35: { 'peso_min': 9.8, 'peso_max': 20.7, 'altura_min': 83, 'altura_max': 105.8 },
                        36: { 'peso_min': 9.9, 'peso_max': 21, 'altura_min': 83.9, 'altura_max': 106.3 },
                        37: { 'peso_min': 9.9, 'peso_max': 21.1, 'altura_min': 84, 'altura_max': 107.5 },
                        38: { 'peso_min': 9.9, 'peso_max': 21.7, 'altura_min': 84.9, 'altura_max': 108 },
                        39: { 'peso_min': 10, 'peso_max': 22, 'altura_min': 85, 'altura_max': 109 },
                        40: { 'peso_min': 10, 'peso_max': 22.4, 'altura_min': 86, 'altura_max': 110 },
                        41: { 'peso_min': 10.1, 'peso_max': 22.8, 'altura_min': 86.5, 'altura_max': 110.6 },
                        42: { 'peso_min': 10.4, 'peso_max': 23, 'altura_min': 87, 'altura_max': 111 },
                        43: { 'peso_min': 10.7, 'peso_max': 23.4, 'altura_min': 87.7, 'altura_max': 112 },
                        44: { 'peso_min': 10.8, 'peso_max': 23.8, 'altura_min': 88, 'altura_max': 113 },
                        45: { 'peso_min': 10.9, 'peso_max': 24.1, 'altura_min': 88.8, 'altura_max': 113.7 },
                        46: { 'peso_min': 10.9, 'peso_max': 24.5, 'altura_min': 89, 'altura_max': 114 },
                        47: { 'peso_min': 10.9, 'peso_max': 24.9, 'altura_min': 89.4, 'altura_max': 115 },
                        48: { 'peso_min': 11, 'peso_max': 25.1, 'altura_min': 90, 'altura_max': 115.8 },
                        49: { 'peso_min': 11, 'peso_max': 25.5, 'altura_min': 90.4, 'altura_max': 116.3 },
                        50: { 'peso_min': 11.1, 'peso_max': 26, 'altura_min': 91, 'altura_max': 117 },
                        51: { 'peso_min': 11.2, 'peso_max': 26.4, 'altura_min': 91.4, 'altura_max': 118 },
                        52: { 'peso_min': 11.4, 'peso_max': 26.8, 'altura_min': 91.9, 'altura_max': 118.7 },
                        53: { 'peso_min': 11.5, 'peso_max': 27, 'altura_min': 92, 'altura_max': 119 },
                        54: { 'peso_min': 11.6, 'peso_max': 27.4, 'altura_min': 92.6, 'altura_max': 120 },
                        55: { 'peso_min': 11.7, 'peso_max': 27.8, 'altura_min': 93, 'altura_max': 120.5 },
                        56: { 'peso_min': 11.8, 'peso_max': 28.1, 'altura_min': 93.4, 'altura_max': 121 },
                        57: { 'peso_min': 11.9, 'peso_max': 28.5, 'altura_min': 94, 'altura_max': 122 },
                        58: { 'peso_min': 12.1, 'peso_max': 28.8, 'altura_min': 94.4, 'altura_max': 122.7 },
                        59: { 'peso_min': 12.4, 'peso_max': 29.3, 'altura_min': 95, 'altura_max': 123.8 },
                        60: { 'peso_min': 12.6, 'peso_max': 29.9, 'altura_min': 95.4, 'altura_max': 124.3 }
                    };
                
                    document.getElementById('predictionForm').addEventListener('submit', function (event) {
                        event.preventDefault(); // Evitar el envío del formulario por defecto
                
                        const edadInput = document.getElementById('edad');
                        const pesoInput = document.getElementById('peso');
                        const alturaInput = document.getElementById('altura');
                        const hmgInput = document.getElementById('hmg');
                
                        const edad = parseInt(edadInput.value);
                        const peso = parseFloat(pesoInput.value);
                        const altura = parseFloat(alturaInput.value);
                        const hmg = parseFloat(hmgInput.value);
                
                        // Validar edad
                        if (!rangoEdad[edad]) {
                            Swal.fire({
                                title: 'Error de Validación',
                                text: "La edad debe estar entre 6 y 60 meses",
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                edadInput.value = '';
                            });
                            return;
                        }
                
                        // Validar peso y altura
                        const rango = rangoEdad[edad];
                        if (peso < rango.peso_min || peso > rango.peso_max) {
                            Swal.fire({
                                title: 'Error de Validación',
                                text: `El peso debe estar entre ${rango.peso_min} y ${rango.peso_max} kg para una edad de ${edad} meses`,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                pesoInput.value = '';
                            });
                            return;
                        }
                
                        if (altura < rango.altura_min || altura > rango.altura_max) {
                            Swal.fire({
                                title: 'Error de Validación',
                                text: `La altura debe estar entre ${rango.altura_min} y ${rango.altura_max} cm para una edad de ${edad} meses`,
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                alturaInput.value = '';
                            });
                            return;
                        }
                
                        // Validar la hemoglobina
                        if (isNaN(hmg) || hmg < 7 || hmg > 18.5) {
                            Swal.fire({
                                title: 'Error de Validación',
                                text: "Ingresa los datos de la hemoglobina dentro del rango de 7 y 18.5",
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            }).then(() => {
                                hmgInput.value = '';
                            });
                            return;
                        }
                
                        // Si la validación es correcta, enviar el formulario mediante AJAX
                        $.ajax({
                            url: "{{ route('anemia_p') }}", // Ruta del controlador
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Token CSRF para la seguridad
                            },
                            data: $(this).serialize(), // Serializa los datos del formulario
                            
                            success: function(response) {
                                Swal.fire({
                                    title: 'Esperando resultado...',
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                setTimeout(() => {
                                    // Cerrar la alerta con el spinner de carga
                                    Swal.close();
                                    // Mostrar la alerta con el resultado de la predicción
                                    Swal.fire({
                                      title: 'Predicción de Anemia',
                                      text: "La predicción es: " + response.prediccion,
                                      icon: 'info',
                                      confirmButtonText: 'Aceptar'
                                   }).then((result) => {
                                        if (result.isConfirmed) {
                                            Swal.fire({
                                                title: 'Enviar a WhatsApp',
                                                text: "¿Deseas enviar esta información a WhatsApp?",
                                                icon: 'question',
                                                input: 'text',
                                                inputPlaceholder: 'Ingrese su número de WhatsApp',
                                                showCancelButton: true,
                                                confirmButtonText: 'Sí, enviar',
                                                cancelButtonText: 'No, gracias',
                                                preConfirm: (numero) => {
                                                    if (!numero) {
                                                        Swal.showValidationMessage('Por favor, ingrese un número de WhatsApp');
                                                    }
                                                    return numero;
                                                }
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    Swal.fire({
                                                        title: 'Enviando resultados...',
                                                        allowOutsideClick: false,
                                                        didOpen: () => {
                                                            Swal.showLoading();
                                                        }
                                                    });
                                                  // Simular una espera o realizar tu operación asíncrona (aquí uso setTimeout para simular el tiempo de espera)
                                                    setTimeout(() => {
                                                        
                                                        // Tu código para construir el mensaje y enviar la solicitud AJAX
                                                        var contentText = `Nombre: ${$("#nombre").val()}, 
                                                        DNI: ${$("#dni").val()}, 
                                                        Edad(meses): ${$("#edad").val()}, 
                                                        Peso(kg): ${$("#peso").val()}, 
                                                        Altura(cm): ${$("#altura").val()}, 
                                                        Sexo: ${$("#sexo").val() == 'M' ? 'Hombre' : 'Mujer'}, 
                                                        HMG: ${$("#hmg").val()},
                                                        Resultado de la prueba: ${response.prediccion}`;
                                                        
                                                        $("#content").val(contentText);

                                                        $.ajax({
                                                            url: "/chat", // URL a la que se envía la solicitud
                                                            method: 'POST', // Método HTTP utilizado
                                                            headers: {
                                                                'X-CSRF-TOKEN': "{{ csrf_token() }}" // Token CSRF para la seguridad
                                                            },
                                                            data: {
                                                                "content": contentText, // Datos enviados en la solicitud
                                                                "phone": result.value // Número de celular
                                                            }
                                                        }).done(function() {
                                                            // Cerrar la alerta de carga y mostrar la alerta de éxito
                                                            Swal.close();
                                                            Swal.fire('Enviado', 'La información ha sido enviada a WhatsApp', 'success').then(() => {
                                                                // Limpiar los campos del formulario
                                                                $("#dni").val('');
                                                                $("#nombre").val('');
                                                                $("#edad").val('');
                                                                $("#peso").val('');
                                                                $("#altura").val('');
                                                                $("#sexo").val('');
                                                                $("#hmg").val('');
                                                            });
                                                        }).fail(function() {
                                                            // Cerrar la alerta de carga y mostrar la alerta de error
                                                            Swal.close();
                                                            Swal.fire('Error', 'Hubo un problema al enviar la información', 'error');
                                                        });
                                                    }, 5000);
                                                    // var contentText = `Nombre: ${$("#nombre").val()}, DNI: ${$("#dni").val()}, Edad(meses): ${$("#edad").val()}, Peso(kg): ${$("#peso").val()}, Altura(cm): ${$("#altura").val()}, Sexo: ${$("#sexo").val() == 'M' ? 'Hombre' : 'Mujer'}, HMG: ${$("#hmg").val()}, Resultado de la prueba: ${response.prediccion}`;
                    
                                                    // $("#content").val(contentText);
                    
                                                    // $.ajax({
                                                    //     url: "/chat", // URL a la que se envía la solicitud
                                                    //     method: 'POST', // Método HTTP utilizado
                                                    //     headers: {
                                                    //         'X-CSRF-TOKEN': "{{ csrf_token() }}" // Token CSRF para la seguridad
                                                    //     },
                                                    //     data: {
                                                    //         "content": contentText, // Datos enviados en la solicitud
                                                    //         "phone": result.value // Número de celular
                                                    //     }
                                                    // }).done(function() {
                                                    //     Swal.fire('Enviado', 'La información ha sido enviada a WhatsApp', 'success').then(() => {
                                                    //         $("#dni").val('');
                                                    //         $("#nombre").val('');
                                                    //         $("#edad").val('');
                                                    //         $("#peso").val('');
                                                    //         $("#altura").val('');
                                                    //         $("#sexo").val('');
                                                    //         $("#hmg").val('');
                                                    //     });
                                                    // }).fail(function() {
                                                    //     Swal.fire('Error', 'Hubo un problema al enviar la información', 'error');
                                                    // });
                                                }
                                            });
                                        }
                                    });
                                }, 2000); // Tiempo de espera de 2 segundos 
                                // Swal.fire({
                                //     title: 'Predicción de Anemia',
                                //     text: "La predicción es: " + response.prediccion,
                                //     icon: 'info',
                                //     confirmButtonText: 'Aceptar'
                                // }).then((result) => {
                                //     if (result.isConfirmed) {
                                //         Swal.fire({
                                //             title: 'Enviar a WhatsApp',
                                //             text: "¿Deseas enviar esta información a WhatsApp?",
                                //             icon: 'question',
                                //             input: 'text',
                                //             inputPlaceholder: 'Ingrese su número de WhatsApp',
                                //             showCancelButton: true,
                                //             confirmButtonText: 'Sí, enviar',
                                //             cancelButtonText: 'No, gracias',
                                //             preConfirm: (numero) => {
                                //                 if (!numero) {
                                //                     Swal.showValidationMessage('Por favor, ingrese un número de WhatsApp');
                                //                 }
                                //                 return numero;
                                //             }
                                //         }).then((result) => {
                                //             if (result.isConfirmed) {
                                //                 Swal.fire({
                                //                     title: 'Enviando datos...',
                                //                     allowOutsideClick: false,
                                //                     didOpen: () => {
                                //                         Swal.showLoading();
                                //                     }
                                //                 });
                                //                 var contentText = `Nombre: ${$("#nombre").val()}, DNI: ${$("#dni").val()}, Edad(meses): ${$("#edad").val()}, Peso(kg): ${$("#peso").val()}, Altura(cm): ${$("#altura").val()}, Sexo: ${$("#sexo").val() == 'M' ? 'Hombre' : 'Mujer'}, HMG: ${$("#hmg").val()}, Resultado de la prueba: ${response.prediccion}`;
                
                                //                 $("#content").val(contentText);
                
                                //                 $.ajax({
                                //                     url: "/chat", // URL a la que se envía la solicitud
                                //                     method: 'POST', // Método HTTP utilizado
                                //                     headers: {
                                //                         'X-CSRF-TOKEN': "{{ csrf_token() }}" // Token CSRF para la seguridad
                                //                     },
                                //                     data: {
                                //                         "content": contentText, // Datos enviados en la solicitud
                                //                         "phone": result.value // Número de celular
                                //                     }
                                //                 }).done(function() {
                                //                     Swal.fire('Enviado', 'La información ha sido enviada a WhatsApp', 'success').then(() => {
                                //                         $("#dni").val('');
                                //                         $("#nombre").val('');
                                //                         $("#edad").val('');
                                //                         $("#peso").val('');
                                //                         $("#altura").val('');
                                //                         $("#sexo").val('');
                                //                         $("#hmg").val('');
                                //                     });
                                //                 }).fail(function() {
                                //                     Swal.fire('Error', 'Hubo un problema al enviar la información', 'error');
                                //                 });
                                //             }
                                //         });
                                //     }
                                // });
                            },
                            error: function() {
                                Swal.fire('Error', 'Hubo un problema al procesar la predicción', 'error');
                            }
                        });
                    });
                </script>
            
           </div>
        </form>
    </div>
@endsection

<style>
  .appointment-button {
      background-color: #3B8BD3; /* Color de fondo */
      border: none; /* Sin borde */
      color: white; /* Color del texto */
      padding: 10px 20px; /* Espaciado interno */
      text-align: center; /* Alineación del texto */
      text-decoration: none; /* Sin subrayado */
      display: inline-block; /* Mostrar en línea */
      font-size: 16px; /* Tamaño de la fuente */
      border-radius: 20px; /* Bordes redondeados */
      cursor: pointer; /* Manito al pasar el mouse */
  }
  
  .appointment-button:hover {
      background-color: #3071a9; /* Color de fondo al pasar el mouse */
  }
  
  .alerta_perso {
      color: #721c24;
      background-color: #f8d7da;
      border-color: #f5c6cb;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
  }
</style>

@section('scripts')
<script>
document.getElementById('dni').addEventListener('blur', function() {
    var dni = this.value;
    if (dni.length === 8) {
        fetch(`/buscar-registro/${dni}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('nombre').value = data.nombre_apellido;
                    document.getElementById('edad').value = data.edad;
                    document.getElementById('peso').value = data.peso;
                    document.getElementById('altura').value = data.altura;
                    document.getElementById('sexo').value = data.sexo;
                    document.getElementById('hmg').value = data.hmg;
                }
            }).catch(error => {
                console.error('Error:', error);
            });
    }
});
</script>
@endsection
