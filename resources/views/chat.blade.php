<!DOCTYPE html>
<html lang="en">
<head>
  <title>Chat GPT Laravel</title>
  <link rel="icon" href="https://assets.edlin.app/favicon/favicon.ico"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- JavaScript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <!-- End JavaScript -->

  <!-- CSS -->
  <link rel="stylesheet" href="/style.css">
  <!-- End CSS -->

</head>

<body>
<div class="chat">

  <!-- Header -->
  <div class="top">
    <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
    <div>
      <p>Ross Edlin</p>
      <small>Online</small>
    </div>
  </div>
  <!-- End Header -->

  <!-- Chat -->
  <div class="messages">
    <div class="left message">
      <img src="https://assets.edlin.app/images/rossedlin/03/rossedlin-03-100.jpg" alt="Avatar">
      <p>Start chatting with Chat GPT AI below!!</p>
    </div>
  </div>
  <!-- End Chat -->

  <!-- Footer -->
  <div class="bottom">
    {{-- <form>
      <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
      <button type="submit"></button>
    </form> --}}
    {{-- <form action="" method="POST">
      @csrf
      <textarea id="message" name="message" class="form-control" rows="9">{{ $datos ? 'Nombre: ' . $datos->nombre_apellido . ', DNI: ' . $datos->dni . ', Fecha: ' . $datos->fecha . ', Hora: ' . $datos->hora . ', Edad(meses): ' . $datos->edad . ', Sexo: ' . $datos->sexo . ', HMG' . $datos->hmg . ', Tipo de Prueba: ' . $datos->tipo_prediccion . ', Resultado de la prueba: ' . $datos->resultado: ''}}</textarea>
      <button type="submit"></button>
    </form> --}}
    <form >
      <textarea  id="message" name="message" class="form-control" rows="9">
          @if(is_object($datos))
              Nombre: {{ $datos->nombre_apellido }}, 
              DNI: {{ $datos->dni }}, 
              Fecha: {{ $datos->fecha }}, 
              Hora: {{ $datos->hora }}, 
              Edad(meses): {{ $datos->edad }}, 
              Sexo: {{ $datos->sexo == 'M' ? 'Hombre' : 'Mujer' }}, 
              HMG: {{ $datos->hmg }}, 
              Tipo de Prueba: {{ $datos->tipo_prediccion == 1 ? 'Anemia' : ($datos->tipo_prediccion == 2 ? 'Severidad' : 'Tipo de Anemia') }}, 
              Resultado de la prueba: {{ $datos->resultado }}
          @else
            <p>hola</p>
          @endif
      </textarea>
      <input type="text" id="phone" name="phone" placeholder="Ingrese número de celular">
      <button type="submit"></button>
    </form>
  
  </div>
  <!-- End Footer -->

</div>
</body>

<script>
  // Maneja el envío de mensajes
  $("form").submit(function (event) {
    event.preventDefault(); // Previene el comportamiento por defecto del formulario (recargar la página)

    // Detiene el envío de mensajes vacíos
    if ($("form #message").val().trim() === '') {
      return; // Si el mensaje está vacío, no hace nada
    }

    // Deshabilita el formulario
    $("form #message").prop('disabled', true); // Deshabilita el campo de entrada del mensaje
    $("form button").prop('disabled', true); // Deshabilita el botón de envío

    // Envía una solicitud AJAX al servidor
    $.ajax({
      url: "/chat", // URL a la que se envía la solicitud
      method: 'POST', // Método HTTP utilizado
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}" // Token CSRF para la seguridad
      },
      data: {
        "content": $("form #message").val(), // Datos enviados en la solicitud (el contenido del mensaje)
        "phone": $("form #phone").val() // Número de celular
      }
    }).done(function (res) { // Función que se ejecuta cuando la solicitud se completa con éxito

      // Limpia el campo de entrada del mensaje y el número de celular
      $("form #message").val(''); // Vacía el campo de entrada del mensaje
      $("form #phone").val(''); // Vacía el campo de entrada del número de celular
      $(document).scrollTop($(document).height()); // Desplaza la página hacia abajo para mostrar el nuevo mensaje

      // Habilita el formulario nuevamente
      $("form #message").prop('disabled', false); // Habilita el campo de entrada del mensaje
      $("form button").prop('disabled', false); // Habilita el botón de envío
    });
  });
</script>
</html>