@extends('layout.plantilla')
@section('contenido')
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Contacto</h2>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">

          <form action="#" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
              <div class="col-md-4 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Correo" required>
              </div>
              <div class="col-md-4 form-group mt-3 mt-md-0">
                  <input type="text" class="form-control" name="telefono" id="telefono" placeholder="telefono" required>
              </div>
            </div>
            <div class="mt-3 text-center">
              <button type="submit" class="appointment-button">Enviar</button>
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
  </style>